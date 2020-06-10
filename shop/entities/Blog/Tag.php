<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 21:59
 */

namespace shop\entities\Blog;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $name_uk
 * @property string $slug
 */
class Tag extends ActiveRecord
{
    public static function create($name, $name_uk, $slug): self
    {
        $tag = new static();
        $tag->name = $name;
        $tag->name_uk = $name_uk;
        $tag->slug = $slug;
        return $tag;
    }

    public function edit($name, $name_uk, $slug): void
    {
        $this->name = $name;
        $this->name_uk = $name_uk;
        $this->slug = $slug;
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'name_uk' => 'Имя uk',
            'slug' => 'Транслит'
        ];
    }

    public static function tableName(): string
    {
        return '{{%blog_tags}}';
    }
}