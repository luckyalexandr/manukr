<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.08.18
 * Time: 16:08
 */

namespace shop\forms\manage;

use shop\entities\Meta;
use yii\base\Model;

class MetaForm extends Model
{
    public $title;
    public $title_uk;
    public $description;
    public $description_uk;
    public $keywords;
    public $keywords_uk;

    public function __construct(Meta $meta = null, $config = [])
    {
        if ($meta) {
            $this->title = $meta->title;
            $this->title_uk = $meta->title_uk;
            $this->description = $meta->description;
            $this->description_uk = $meta->description_uk;
            $this->keywords = $meta->keywords;
            $this->keywords_uk = $meta->keywords_uk;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
//            [['title', 'description', 'keywords'], 'required'],
            [['title', 'title_uk'], 'string', 'max' => 255],
            [['description', 'description_uk', 'keywords', 'keywords_uk'], 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'title' => Yii::t('models', 'Заголовок'),
            'description' => Yii::t('models', 'Описание'),
            'keywords' => Yii::t('models', 'Ключевые слова'),
            'title_uk' => Yii::t('models', 'Заголовок на украинском'),
            'description_uk' => Yii::t('models', 'Описание на украинском'),
            'keywords_uk' => Yii::t('models', 'Ключевые слова на украинском'),
        ];
    }
}