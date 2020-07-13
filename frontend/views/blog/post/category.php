<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:32
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Blog\Category */

use yii\helpers\Html;

$this->title = Yii::$app->language == 'ru' ? $category->title : $category->title_uk;

$this->registerMetaTag(['name' =>'title', 'content' => Yii::$app->language == 'ru' ? $category->meta->title : $category->meta->title_uk]);
$this->registerMetaTag(['name' =>'description', 'content' => Yii::$app->language == 'ru' ? $category->meta->description : $category->meta->description_uk]);
$this->registerMetaTag(['name' =>'keywords', 'content' => Yii::$app->language == 'ru' ? $category->meta->keywords : $category->meta->keywords_uk]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Блог'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::$app->language == 'ru' ? $category->name : $category->name_uk;

$this->params['active_category'] = $category;
?>

<h1><?= Html::encode($category->getHeadingTile()) ?></h1>

<?php if (trim($category->description)): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= Yii::$app->formatter->asNtext(Yii::$app->language == 'ru' ? $category->description : $category->description_uk) ?>
        </div>
    </div>
<?php endif; ?>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>


