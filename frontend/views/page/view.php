<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.02.19
 * Time: 8:44
 */

use yii\helpers\Html;
use \frontend\widgets\Feedback\Samples;

/* @var $this yii\web\View */
/* @var $page \shop\entities\Page */

$this->title = Yii::$app->language == 'ru' ? $page->title : $page->title_uk;

$this->registerMetaTag(['name' => 'title', 'content' => Yii::$app->language == 'ru' ? $page->meta->title : $page->meta->title_uk]);
$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->language == 'ru' ? $page->meta->description : $page->meta->description_uk]);
$this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->language == 'ru' ? $page->meta->keywords : $page->meta->keywords_uk]);

foreach ($page->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => Yii::$app->language == 'ru' ? $parent->title : $page->title_uk, 'url' => ['view', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = Yii::$app->language == 'ru' ? $page->title : $page->title_uk;
?>
<div class="container page-view">
    <article class="page-text">

        <h1><?= Html::encode(Yii::$app->language == 'ru' ? $page->title : $page->title_uk) ?></h1>

        <?= Yii::$app->language == 'ru' ? $page->content : $page->content_uk ?>

        <?php if (Yii::$app->request->url == '/samples'): ?>

            <?= Samples::widget(); ?>

        <?php endif; ?>

    </article>
</div>
