<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 22:01
 */

namespace shop\entities\Blog;

use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $name_uk
 * @property string $slug
 * @property string $slug_uk
 * @property string $title
 * @property string $title_uk
 * @property string $description
 * @property string $description_uk
 * @property int $sort
 * @property integer $created_at
 * @property integer $updated_at
 * @property Meta $meta
 */
class Category extends ActiveRecord
{
    public $meta;

    public static function create($name, $name_uk, $slug, $slug_uk, $title, $title_uk, $description, $description_uk, $sort, Meta $meta): self
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
        $category->sort = $sort;
        $category->meta = $meta;
        $category->created_at = time();
        $category->updated_at = time();
        return $category;
    }

    public function edit($name, $name_uk, $slug, $slug_uk, $title, $title_uk, $description, $description_uk, $sort, Meta $meta): void
    {
        $this->name = $name;
        $this->name_uk = $name_uk;
        $this->slug = $slug;
        $this->slug_uk = $slug_uk;
        $this->title = $title;
        $this->title_uk = $title_uk;
        $this->description = $description;
        $this->description_uk = $description_uk;
        $this->sort = $sort;
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

    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'name_uk' => 'Имя укр',
            'slug' => 'Транслит',
            'title' => 'Заголовок',
            'title_uk' => 'Заголовок укр',
            'description' => 'Описание',
            'description_uk' => 'Описание укр',
            'sort' => 'Позиция',
        ];
    }

    public static function tableName(): string
    {
        return '{{%blog_categories}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
        ];
    }
}