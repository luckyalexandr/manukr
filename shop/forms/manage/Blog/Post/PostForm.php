<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 23:14
 */

namespace shop\forms\manage\Blog\Post;

use shop\entities\Blog\Category;
use shop\entities\Blog\Post\Post;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use shop\validators\SlugValidator;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * @property MetaForm $meta
 * @property TagsForm $tags
 */
class PostForm extends CompositeForm
{
    public $categoryId;
    public $title;
    public $description;
    public $content;
    public $photo;

    public function __construct(Post $post = null, $config = [])
    {
        if ($post) {
            $this->categoryId = $post->category_id;
            $this->title = $post->title;
            $this->title = $post->title_uk;
            $this->description = $post->description;
            $this->description = $post->description_uk;
            $this->content = $post->content;
            $this->content = $post->content_uk;
            $this->meta = new MetaForm($post->meta);
            $this->tags = new TagsForm($post);
        } else {
            $this->meta = new MetaForm();
            $this->tags = new TagsForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['categoryId', 'title', 'title_uk'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['categoryId'], 'integer'],
            [['description', 'content', 'description_uk', 'content_uk'], 'string'],
            [['photo'], 'image'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'categoryId' => 'Категория',
            'description' => 'Описание',
            'title' => 'Заголовок',
            'description_uk' => 'Описание Uk',
            'title_uk' => 'Заголовок Uk',
            'photo' => 'Заглавное фото',
            'content' => 'Полный текст',
            'content_uk' => 'Полный текст Uk',
        ];
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('sort')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['meta', 'tags'];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->photo = UploadedFile::getInstance($this, 'photo');
            return true;
        }
        return false;
    }
}