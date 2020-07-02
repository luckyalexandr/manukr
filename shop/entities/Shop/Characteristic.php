<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.12.18
 * Time: 10:14
 */

namespace shop\entities\Shop;

use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * Class Characteristic
 * @package shop\entities\Shop
 * @property integer $id
 * @property string $name
 * @property string $name_uk
 * @property string $type
 * @property string $required
 * @property string $default
 * @property string $default_uk
 * @property array $variants
 * @property array $variants_uk
 * @property integer $sort
 */
class Characteristic extends ActiveRecord
{
    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';

    public $variants;

    public static function create($name, $name_uk, $type, $required, $default, $default_uk, array $variants, array $variants_uk, $sort): self
    {
        $object = new static();
        $object->name = $name;
        $object->name_uk = $name_uk;
        $object->type = $type;
        $object->required = $required;
        $object->default = $default;
        $object->default_uk = $default_uk;
        $object->variants = $variants;
        $object->variants_uk = $variants_uk;
        $object->sort = $sort;
        return $object;
    }

    public function edit($name, $name_uk, $type, $required, $default, $default_uk, array $variants, array $variants_uk, $sort): void
    {
        $this->name = $name;
        $this->name_uk = $name_uk;
        $this->type = $type;
        $this->required = $required;
        $this->default = $default;
        $this->default_uk = $default_uk;
        $this->variants = $variants;
        $this->variants_uk = $variants_uk;
        $this->sort = $sort;
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'name' => 'Наименование Uk',
            'type' => 'Тип',
            'sort' => 'Сортировка',
            'required' => 'Обязательно',
            'textVariants' => 'Варианты',
            'textVariants' => 'Варианты Uk',
            'default' => 'По умолчанию',
        ];
    }

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }

    public static function tableName(): string
    {
        return '{{%shop_characteristics}}';
    }

    public function afterFind(): void
    {
        $this->variants = Json::decode($this->getAttribute('variants_json'));
        $this->variants_uk = Json::decode($this->getAttribute('variants_uk_json'));
        parent::afterFind();
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('variants_json', Json::encode($this->variants));
        $this->setAttribute('variants_uk_json', Json::encode($this->variants_uk));
        return parent::beforeSave($insert);
    }
}