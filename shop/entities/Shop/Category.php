<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.12.18
 * Time: 1:45
 */

namespace shop\entities\Shop;


use paulzi\nestedsets\NestedSetsBehavior;
use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use shop\entities\Shop\queries\CategoryQuery;
use yii\db\ActiveRecord;

/**
 * Class Category
 * @package shop\entities\Shop
 * @property integer $id
 * @property string $name
 * @property string $name_uk
 * @property string $slug
 * @property string $slug_uk
 * @property string $title
 * @property string $title_uk
 * @property string $description
 * @property string $description_uk
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property Meta $meta
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $parent
 * @property Category[] $parents
 * @property Category[] $children
 * @property Category $prev
 * @property Category $next
 * @mixin NestedSetsBehavior
 */

class Category extends ActiveRecord
{
    public $meta;

    public static function create($name, $name_uk, $slug, $slug_uk, $title, $title_uk, $description, $description_uk, Meta $meta): self
    {
        $category = new static();
        $category->name = $name;
        $category->name_uk = $name_uk;
        $category->slug = $slug;
        $category->slug_uk = $slug_uk;
        $category->title = $title;
        $category->title_uk = $title_uk;
        $category->description = $description;
        $category->description_uk = $description_uk;
        $category->meta = $meta;
        $category->created_at = time();
        $category->updated_at = time();
        return $category;
    }

    public function edit($name, $name_uk, $slug, $slug_uk, $title, $title_uk, $description, $description_uk, Meta $meta): void
    {
        $this->name = $name;
        $this->name_uk = $name_uk;
        $this->slug = $slug;
        $this->slug_uk = $slug_uk;
        $this->title = $title;
        $this->title_uk = $title_uk;
        $this->description = $description;
        $this->description_uk = $description_uk;
        $this->meta = $meta;
        $this->updated_at = time();
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTile();
    }

    public function getHeadingTile(): string
    {
        return Yii::$app->language == 'ru' ? ($this->title ?: $this->name) : ($this->title_uk ?: $this->name_uk);
    }

    public static function tableName(): string
    {
        return '{{%shop_categories}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            NestedSetsBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'name_uk' => 'Наименование ukr',
            'parentId' => 'Родительская категория',
            'title' => 'Заголовок',
            'title_uk' => 'Заголовок ukr',
            'slug' => 'Транслит',
            'slug_uk' => 'Транслит ukr',
            'description' => 'Описание',
            'description_uk' => 'Описание ukr',
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }
}