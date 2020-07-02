<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 22:02
 */

namespace shop\entities\Blog\Post;

use shop\entities\Blog\Post\Comment;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use shop\entities\behaviors\MetaBehavior;
use shop\entities\Blog\Post\queries\CommentQuery;
use shop\entities\Blog\Post\queries\PostQuery;
use shop\entities\Meta;
use shop\entities\Blog\Category;
use shop\entities\Blog\Tag;
use shop\services\WaterMarker;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $title
 * @property string $title_uk
 * @property string $description
 * @property string $description_uk
 * @property string $content
 * @property string $content_uk
 * @property string $photo
 * @property integer $status
 * @property integer $comments_count
 *
 * @property Meta $meta
 * @property Category $category
 * @property TagAssignment[] $tagAssignments
 * @property Tag[] $tags
 * @property Comment[] $comments
 *
 * @mixin ImageUploadBehavior
 */
class Post extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public $meta;

    public static function create($categoryId, $title, $title_uk, $description, $description_uk, $content, $content_uk, Meta $meta): self
    {
        $post = new static();
        $post->category_id = $categoryId;
        $post->title = $title;
        $post->title_uk = $title_uk;
        $post->description = $description;
        $post->description_uk = $description_uk;
        $post->content = $content;
        $post->content_uk = $content_uk;
        $post->meta = $meta;
        $post->status = self::STATUS_DRAFT;
        $post->created_at = time();
        $post->updated_at = time();
        $post->comments_count = 0;
        return $post;
    }

    public function setPhoto(UploadedFile $photo): void
    {
        $this->photo = $photo;
    }

    public function edit($categoryId, $title, $title_uk, $description, $description_uk, $content, $content_uk, Meta $meta): void
    {
        $this->category_id = $categoryId;
        $this->title = $title;
        $this->title_uk = $title_uk;
        $this->description = $description;
        $this->description_uk = $description_uk;
        $this->content = $content;
        $this->content_uk = $content_uk;
        $this->meta = $meta;
        $this->updated_at = time();
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('Post is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function draft(): void
    {
        if ($this->isDraft()) {
            throw new \DomainException('Post is already draft.');
        }
        $this->status = self::STATUS_DRAFT;
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }


    public function isDraft(): bool
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function getSeoTitle(): string
    {
        return Yii::$app->language == 'ru' ? ($this->meta->title ?: $this->title) : ($this->meta->title_uk ?: $this->title_uk);
    }

    // Tags

    public function assignTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForTag($id)) {
                return;
            }
        }
        $assignments[] = TagAssignment::create($id);
        $this->tagAssignments = $assignments;
    }

    public function revokeTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForTag($id)) {
                unset($assignments[$i]);
                $this->tagAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeTags(): void
    {
        $this->tagAssignments = [];
    }

    // Comments

    public function addComment($userId, $parentId, $text): Comment
    {
        $parent = $parentId ? $this->getComment($parentId) : null;
        if ($parent && !$parent->isActive()) {
            throw new \DomainException('Cannot add comment to inactive parent.');
        }
        $comments = $this->comments;
        $comments[] = $comment = Comment::create($userId, $parent ? $parent->id : null, $text);
        $this->updateComments($comments);
        return $comment;
    }

    public function editComment($id, $parentId, $text): void
    {
        $parent = $parentId ? $this->getComment($parentId) : null;
        $comments = $this->comments;
        foreach ($comments as $comment) {
            if ($comment->isIdEqualTo($id)) {
                $comment->edit($parent ? $parent->id : null, $text);
                $this->updateComments($comments);
                return;
            }
        }
        throw new \DomainException('Comment is not found.');
    }

    public function activateComment($id): void
    {
        $comments = $this->comments;
        foreach ($comments as $comment) {
            if ($comment->isIdEqualTo($id)) {
                $comment->activate();
                $this->updateComments($comments);
                return;
            }
        }
        throw new \DomainException('Comment is not found.');
    }

    public function removeComment($id): void
    {
        $comments = $this->comments;
        foreach ($comments as $i => $comment) {
            if ($comment->isIdEqualTo($id)) {
                if ($this->hasChildren($comment->id)) {
                    $comment->draft();
                } else {
                    unset($comments[$i]);
                }
                $this->updateComments($comments);
                return;
            }
        }
        throw new \DomainException('Comment is not found.');
    }

    public function getComment($id): Comment
    {
        foreach ($this->comments as $comment) {
            if ($comment->isIdEqualTo($id)) {
                return $comment;
            }
        }
        throw new \DomainException('Comment is not found.');
    }

    private function hasChildren($id): bool
    {
        foreach ($this->comments as $comment) {
            if ($comment->isChildOf($id)) {
                return true;
            }
        }
        return false;
    }

    private function updateComments(array $comments): void
    {
        $this->comments = $comments;
        $this->comments_count = count(array_filter($comments, function (Comment $comment) {
            return $comment->isActive();
        }));
    }

    ##########################

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getTagAssignments(): ActiveQuery
    {
        return $this->hasMany(TagAssignment::class, ['post_id' => 'id']);
    }

    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->via('tagAssignments');
    }

    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    ##########################

    public function attributeLabels(): array
    {
        return [
            'category_id' => 'Категория',
            'description' => 'Описание',
            'title' => 'Заголовок',
            'description' => 'Описание Uk',
            'title' => 'Заголовок Uk',
            'photo' => 'Заглавное фото',
            'content' => 'Полный текст',
            'content' => 'Полный текст Uk',
            'created_at' => 'Создан',
            'status' => 'Статус',
        ];
    }

    public static function tableName(): string
    {
        return '{{%blog_posts}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['tagAssignments', 'comments'],
            ],
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@webroot/origin/posts/[[id]].[[extension]]',
                'fileUrl' => '@web/origin/posts/[[id]].[[extension]]',
                'thumbPath' => '@webroot/cache/posts/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@web/cache/posts/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 640, 'height' => 480],
                    'blog_list' => ['width' => 1000, 'height' => 150],
                    'widget_list' => ['width' => 228, 'height' => 228],
                    'origin' => ['processor' => [new WaterMarker(1024, 768, '@frontend/web/uploads/logo/logo.png'), 'process']],
                ],
            ],
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): PostQuery
    {
        return new PostQuery(static::class);
    }
}