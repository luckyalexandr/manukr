<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:33
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $tag shop\entities\Shop\Tag */

use yii\helpers\Html;

$this->title = Yii::t('blog', 'Записи с тегом ') . Yii::$app->language == 'ru' ? $tag->name : $tag->name_uk;

$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Блог'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::$app->language == 'ru' ? $tag->name : $tag->name_uk;
?>

    <h1><?= Yii::t('blog', 'Записи с тегом '); ?>&laquo;<?= Html::encode(Yii::$app->language == 'ru' ? $tag->name : $tag->name_uk) ?>&raquo;</h1>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>