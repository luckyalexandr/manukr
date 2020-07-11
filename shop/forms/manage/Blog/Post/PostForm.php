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
    public $title_uk;
    public $description;
    public $description_uk;
    public $content;
    public $content_uk;
    public $photo;

    public function __construct(Post $post = null, $config = [])
    {
        if ($post) {
            $this->categoryId = $post->category_id;
            $this->title = $post->title;
            $this->title_uk = $post->title_uk;
            $this->description = $post->description;
            $this->description_uk = $post->description_uk;
            $this->content = $post->content;
            $this->content_uk = $post->content_uk;
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
            [['title', 'title_uk'], 'string', 'max' => 255],
            [['categoryId'], 'integer'],
            [['description', 'description_uk', 'content', 'content_uk'], 'string'],
            [['photo'], 'image'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'categoryId' => 'Категория',
            'description' => 'Описание',
            'title' => 'Заголовок',
            'photo' => 'Заглавное фото',
            'content' => 'Полный текст',
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