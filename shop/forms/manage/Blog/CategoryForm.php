<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 23:11
 */

namespace shop\forms\manage\Blog;

use shop\entities\Blog\Category;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use shop\validators\SlugValidator;
use Yii;

/**
 * @property MetaForm $meta;
 */
class CategoryForm extends CompositeForm
{
    public $name;
    public $name_uk;
    public $slug;
    public $slug_uk;
    public $title;
    public $title_uk;
    public $description;
    public $description_uk;
    public $sort;

    private $_category;

    public function __construct(Category $category = null, $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->name_uk = $category->name_uk;
            $this->slug = $category->slug;
            $this->slug_uk = $category->slug_uk;
            $this->title = $category->title;
            $this->title_uk = $category->title_uk;
            $this->description = $category->description;
            $this->description_uk = $category->description_uk;
            $this->sort = $category->sort;
            $this->meta = new MetaForm($category->meta);
            $this->_category = $category;
        } else {
            $this->meta = new MetaForm();
            $this->sort = Category::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'name_uk', 'slug', 'slug_uk'], 'required'],
            [['name', 'name_uk', 'slug', 'slug_uk', 'title', 'title_uk'], 'string', 'max' => 255],
            [['description', 'description_uk'], 'string'],
            [['slug', 'slug_uk'], SlugValidator::class],
            [['name', 'name_uk', 'slug', 'slug_uk'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null]
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => Yii::t('models', 'Имя'),
            'slug' => Yii::t('models', 'Транслит'),
            'title' => Yii::t('models', 'Заголовок'),
            'sort' => Yii::t('models', 'Позиция'),
        ];
    }

    public function internalForms(): array
    {
        return ['meta'];
    }
}