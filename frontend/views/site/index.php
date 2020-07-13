<?php

/* @var $this yii\web\View */

use shop\entities\Shop\Product\Product;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Manufacture 17';
\frontend\assets\OwlCarouselAsset::register($this);
?>
<div class="site-index">

    <div class="container">
        <div id="slideshow0" class="owl-carousel">
            <?php foreach ($slider as $slide): ?>
                <div class="slide">
                    <?= (!$slide->link) ? '' : '<a href="' . $slide->link . '">'?>
                    <img src="<?= Html::encode($slide->getThumbFileUrl('image', 'main')) ?>" alt="">
                    <?php if ($slide->title || $slide->text): ?>
                        <div class="slide-text-wrapper">
                            <?= (!$slide->title) ? '' : '<h3>' . Yii::$app->language == 'ru' ? $slide->title : $slide->tite_uk . '</h3>'?>
                            <?= (!$slide->text) ? '' : '<p>' . Yii::$app->language == 'ru' ? $slide->text : $slide->text_uk . '</p>'?>
                        </div>
                    <?php endif; ?>
                    <?= (!$slide->link) ? '' : '</a>'?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <section class="container site-main_newest">

		<h2><?= Yii::t('app', 'Новинки') ?></h2>

        <div class="products row">

        <?= \frontend\widgets\Shop\NewestProductsWidget::widget([
                'limit' => 8,
        ]); ?>

            <div class="col-md-12 text-center button-group">
                <a class="button" href="<?= Url::to('/shop/catalog/newest') ?>" data-method="post"><?= Yii::t('app', 'Смотреть больше') ?></a>
            </div>

        </div>

    </section>

    <section class="container site-main_text">
        <h2><?= Yii::t('app', 'Наши преимущества') ?></h2>

        <div class="col-md-12">
            <div class="col-md-4">
                <i class="fas fa-business-time"></i>
                <p>
                    <?= Yii::t('app', 'Оперативная обработка заказа') ?>
                </p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-chart-line"></i>
                <p>
                    <?= Yii::t('app', 'Гибкая система скидок') ?>
                </p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-hand-holding-usd"></i>
                <p>
                    <?= Yii::t('app', 'Бонусы постоянным клиентам') ?>
                </p>
            </div>
        </div>


    </section>

    <section class="container site-main_top-rated">

        <h2><?= Yii::t('app', 'Популярные товары') ?></h2>

        <div class="products row">

        <?= \frontend\widgets\Shop\FeaturedProductsWidget::widget([
                'limit' => 8,
        ]); ?>

            <div class="col-md-12 text-center button-group">
                <a class="button" href="<?= Url::to('/shop/catalog') ?>" data-method="post"><?= Yii::t('app', 'Смотреть больше') ?></a>
            </div>

        </div>

    </section>

    <section class="container site-main_top-rated">

        <h2><?= Yii::t('app', 'Распродажа') ?></h2>

        <div class="products row">

        <?= \frontend\widgets\Shop\SaleProductsWidget::widget([
                'limit' => 8,
        ]); ?>

            <div class="col-md-12 text-center button-group">
                <a class="button" href="<?= Url::to('/shop/catalog/sale') ?>" data-method="post"><?= Yii::t('app', 'Смотреть больше') ?></a>
            </div>

        </div>

    </section>

</div>
<?php $this->registerJs('
$(\'#slideshow0\').owlCarousel({
    items: 1,
    itemsDesktop : true,
    itemsDesktopSmall : true,
    itemsTablet: true,
    itemsMobile : true,
    responsiveClass: true,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav: true,
    navText: [\'<i class="fas fa-chevron-left fa-5x"></i>\', \'<i class="fas fa-chevron-right fa-5x"></i>\'],
    dots: true
});') ?>

