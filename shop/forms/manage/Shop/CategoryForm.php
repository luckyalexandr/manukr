<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.12.18
 * Time: 9:09
 */

namespace shop\forms\manage\Shop;

use shop\entities\Shop\Category;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use shop\validators\SlugValidator;
use yii\helpers\ArrayHelper;

/**
 * Class CategoryForm
 * @package shop\forms\manage\Shop
 * @property MetaForm $meta
 */
class CategoryForm extends CompositeForm
{
    public $name;
    public $slug;
    public $title;
    public $description;
    public $name_uk;
    public $slug_uk;
    public $title_uk;
    public $description_uk;
    public $parentId;

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
            $this->parentId = $category->parent ? $category->parent->id : null;
            $this->meta = new MetaForm($category->meta);
            $this->_category = $category;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'slug', 'name_uk', 'slug_uk'], 'required'],
            [['parentId'], 'integer'],
            [['name', 'slug', 'title', 'name_uk', 'slug_uk', 'title_uk'], 'string', 'max' => 255],
            [['description', 'description_uk'], 'string'],
            ['slug', SlugValidator::class],
            [['name', 'slug', 'name_uk', 'slug_uk'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null]
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'name_uk' => 'Наименование UK',
            'parentId' => 'Родительская категория',
            'title' => 'Заголовок',
            'slug' => 'Транслит',
            'description' => 'Описание',
            'title_uk' => 'Заголовок Uk',
            'slug_uk' => 'Транслит Uk',
            'description_uk' => 'Описание Uk',
        ];
    }

    public function parentCategoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    protected function internalForms(): array
    {
        return ['meta'];
    }
}