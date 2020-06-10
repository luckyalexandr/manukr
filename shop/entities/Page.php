<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.02.19
 * Time: 8:03
 */

namespace shop\entities;

use paulzi\nestedsets\NestedSetsBehavior;
use shop\entities\behaviors\MetaBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $title
 * @property string $title_uk
 * @property string $slug
 * @property string $slug_uk
 * @property string $content
 * @property string $content_uk
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property Meta $meta
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Page $parent
 * @property Page[] $parents
 * @property Page[] $children
 * @property Page $prev
 * @property Page $next
 * @mixin NestedSetsBehavior
 */
class Page extends ActiveRecord
{
    public $meta;

    public static function create($title, $title_uk, $slug, $slug_uk, $content, $content_uk, Meta $meta): self
    {
        $page = new static();
        $page->title = $title;
        $page->title_uk = $title_uk;
        $page->slug = $slug;
        $page->slug_uk = $slug_uk;
        $page->content = $content;
        $page->content_uk = $content_uk;
        $page->meta = $meta;
        $page->created_at = time();
        $page->updated_at = time();
        return $page;
    }

    public function edit($title, $title_uk, $slug, $slug_uk, $content, $content_uk, Meta $meta): void
    {
        $this->title = $title;
        $this->title_uk = $title_uk;
        $this->slug = $slug;
        $this->slug_uk = $slug_uk;
        $this->content = $content;
        $this->content_uk = $content_uk;
        $this->meta = $meta;
        $this->updated_at = time();
    }

    public function getSeoTitle(): string
    {
        return (Yii::$app->language == 'ru' ? ($this->meta->title ?: $this->title) : ($this->meta->title_uk ?: $this->title_uk));
    }

    public static function tableName(): string
    {
        return '{{%pages}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
            NestedSetsBehavior::className(),
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
}