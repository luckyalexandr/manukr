<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 06.12.18
 * Time: 8:50
 */

namespace shop\entities\behaviors;


use shop\entities\Meta;
use shop\entities\Shop\Brand;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class MetaBehavior extends Behavior
{
    public $attribute = 'meta';
    public $jsonAttribute = 'meta_json';

    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    }

    public function onAfterFind(Event $event): void
    {
        $model = $event->sender;
        $meta = Json::decode($model->getAttribute($this->jsonAttribute));
        $model->{$this->attribute} = new Meta(
            ArrayHelper::getValue($meta, 'title'),
            ArrayHelper::getValue($meta, 'title_uk'),
            ArrayHelper::getValue($meta, 'description'),
            ArrayHelper::getValue($meta, 'description_uk'),
            ArrayHelper::getValue($meta, 'keywords'),
            ArrayHelper::getValue($meta, 'keywords_uk')
        );
    }

    public function onBeforeSave(Event $event): void
    {
        $model = $event->sender;
        $model->setAttribute($this->jsonAttribute, Json::encode([
            'title' => $model->{$this->attribute}->title,
            'title' => $model->{$this->attribute}->title_uk,
            'description' => $model->{$this->attribute}->description,
            'description' => $model->{$this->attribute}->description_uk,
            'keywords' => $model->{$this->attribute}->keywords,
            'keywords' => $model->{$this->attribute}->keywords_uk,
        ]));
    }
}