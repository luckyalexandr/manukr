<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 01.02.19
 * Time: 10:03
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $tag shop\entities\Shop\Tag */

use yii\helpers\Html;

$this->title = Yii::t('shop', 'Товары с меткой ') . Yii::$app->language == 'ru' ? $tag->name : $tag->name_uk;

$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Каталог'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::$app->language == 'ru' ? $tag->name : $tag->name_uk;
?>

    <h1><?= Yii::t('shop', 'Товары с меткой ') ?>&laquo;<?= Html::encode(Yii::$app->language == 'ru' ? $tag->name : $tag->name_uk) ?>&raquo;</h1>

    <hr />

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>