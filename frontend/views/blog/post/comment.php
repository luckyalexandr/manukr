<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:35
 */

/* @var $this yii\web\View */
/* @var $post shop\entities\Blog\Post\Post */
/* @var $model \shop\forms\Blog\CommentForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('blog', 'Комментарий');

$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Блог'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->language == 'ru' ? $post->category->name : $post->category->name_uk, 'url' => ['category', 'slug' => $post->category->slug]];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->language == 'ru' ? $post->title : $post->title_uk, 'url' => ['post', 'id' => $post->id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['active_category'] = $post->category;
?>

<h1><?= Html::encode(Yii::$app->language == 'ru' ? $post->title : $post->title_uk) ?></h1>

<?php $form = ActiveForm::begin([
    'action' => ['comment', 'id' => $post->id],
]); ?>

<?= Html::activeHiddenInput($model, 'parentId') ?>
<?= $form->field($model, 'text')->textarea(['rows' => 5]) ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('blog', 'Отправить комментарий'), ['class' => 'btn btn-4']) ?>
</div>

<?php ActiveForm::end(); ?>
