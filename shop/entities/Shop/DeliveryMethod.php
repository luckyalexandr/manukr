<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 1:51
 */

namespace shop\entities\Shop;

use shop\entities\Shop\queries\DeliveryMethodQuery;
use yii\db\ActiveRecord;
/**
 * @property int $id
 * @property string $name
 * @property string $name_uk
 * @property int $cost
 * @property int $sort
 */
class DeliveryMethod extends ActiveRecord
{
    public static function create($name, $name_uk, $cost, $sort): self
    {
        $method = new static();
        $method->name = $name;
        $method->name_uk = $name_uk;
        $method->cost = $cost;
        $method->sort = $sort;
        return $method;
    }

    public function edit($name, $name_uk, $cost, $sort): void
    {
        $this->name = $name;
        $this->name_uk = $name_uk;
        $this->cost = $cost;
        $this->sort = $sort;
    }

    public static function tableName(): string
    {
        return '{{%shop_delivery_methods}}';
    }

    public static function find(): DeliveryMethodQuery
    {
        return new DeliveryMethodQuery(static::class);
    }
}