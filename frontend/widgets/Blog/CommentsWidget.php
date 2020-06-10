<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:37
 */

namespace frontend\widgets\Blog;

use shop\entities\Blog\Post\Comment;
use frontend\widgets\Blog\CommentView;
use shop\entities\Blog\Post\Post;
use shop\forms\Blog\CommentForm;
use yii\base\InvalidConfigException;
use yii\base\Widget;

class CommentsWidget extends Widget
{
    /**
     * @var Post
     */
    public $post;

    public function init(): void
    {
        if (!$this->post) {
            throw new InvalidConfigException('Specify the post.');
        }
    }

    public function run(): string
    {
        $form = new CommentForm();

        $comments = $this->post->getComments()
            ->orderBy(['parent_id' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        $items = $this->treeRecursive($comments, null);

        return $this->render('comments/comments', [
            'post' => $this->post,
            'items' => $items,
            'commentForm' => $form,
        ]);
    }

    /**
     * @param Comment[] $comments
     * @param integer $parentId
     * @return CommentView[]
     */
    public function treeRecursive(&$comments, $parentId): array
    {
        $items = [];
        foreach ($comments as $comment) {
            if ($comment->parent_id == $parentId) {
                $items[] = new CommentView($comment, $this->treeRecursive($comments, $comment->id));
            }
        }
        return $items;
    }
}