<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 01.02.19
 * Time: 10:03
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $brand shop\entities\Shop\Brand */

use yii\helpers\Html;

$this->title = $brand->name;

$this->registerMetaTag(['name' =>'title', 'content' => Yii::$app->language == 'ru' ? $brand->meta->title : $brand->meta->title_uk]);
$this->registerMetaTag(['name' =>'description', 'content' => Yii::$app->language == 'ru' ? $brand->meta->description : $brand->meta->description_uk]);
$this->registerMetaTag(['name' =>'keywords', 'content' => Yii::$app->language == 'ru' ? $brand->meta->keywords : $brand->meta->keywords_uk]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Каталог'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $brand->name;
?>

<h1><?= Html::encode($brand->name) ?></h1>

<hr />

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>