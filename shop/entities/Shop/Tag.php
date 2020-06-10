<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.08.18
 * Time: 17:12
 */

namespace shop\entities\Shop;


use yii\db\ActiveRecord;
use yii\helpers\Inflector;

/**
 * Class Tag
 * @package shop\entities\Shop
 * @property integer $id
 * @property string $name
 * @property string $name_uk
 * @property string $slug
 */
class Tag extends ActiveRecord
{
    public static function create($name, $name_uk, $slug): self
    {
        $tag = new Tag();
        $tag->name = $name;
        $tag->name_uk = $name_uk;
        $tag->slug = Inflector::slug($slug);
        return $tag;
    }

    public function edit($name, $name_uk, $slug): void
    {
        $this->name = $name;
        $this->name_uk = $name_uk;
        $this->slug = Inflector::slug($slug);
    }

    public static function tableName()
    {
        return '{{%shop_tags}}';
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'name_uk' => 'Наименование uk',
            'slug' => 'Транслит',
        ];
    }
}