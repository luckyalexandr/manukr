<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:33
 */

/* @var $this yii\web\View */
/* @var $post shop\entities\Blog\Post\Post */

use frontend\widgets\Blog\CommentsWidget;
use yii\helpers\Html;

$this->title = Yii::$app->language == 'ru' ? $post->title : $post->title_uk;

$this->registerMetaTag(['name' =>'title', 'content' => Yii::$app->language == 'ru' ? $post->meta->title : $post->meta->title_uk]);
$this->registerMetaTag(['name' =>'description', 'content' => Yii::$app->language == 'ru' ? $post->meta->description : $post->meta->description_uk]);
$this->registerMetaTag(['name' =>'keywords', 'content' => Yii::$app->language == 'ru' ? $post->meta->keywords : $post->meta->keywords_uk]);

$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->language == 'ru' ? $post->category->name : $post->category->name_uk, 'url' => ['category', 'slug' => $post->category->slug]];
$this->params['breadcrumbs'][] = Yii::$app->language == 'ru' ? $post->title : $post->title_uk;

$this->params['active_category'] = $post->category;

$tagLinks = [];
foreach ($post->tags as $tag) {
    $tagLinks[] = Html::a(Html::encode($tag->name), ['tag', 'slug' => $tag->slug]);
}
?>

<article class="blog-post">
    <h1><?= Html::encode(Yii::$app->language == 'ru' ? $post->title : $post->title_uk) ?></h1>

    <p class="post-data"><span class="glyphicon glyphicon-calendar"></span> <?= Yii::$app->formatter->asDatetime($post->created_at); ?></p>

    <?php if ($post->photo): ?>
        <figure class="post-image"><img src="<?= Html::encode($post->getThumbFileUrl('photo', 'origin')) ?>" alt="" class="img-responsive" /></figure>
    <?php endif; ?>

    <div class="post-text"><?= Yii::$app->language == 'ru' ? $post->content : $post->content_uk ?></div>
</article>

<p class="blog-post-tags"><?= Yii::t('blog', 'Теги:') ?> <?= implode(', ', $tagLinks) ?></p>

<?= CommentsWidget::widget([
    'post' => $post,
]) ?>
