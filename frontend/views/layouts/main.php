<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 24.01.19
 * Time: 9:38
 */

/* @var $this \yii\web\View */
/* @var $content string */

//use frontend\widgets\CategoriesListWidget;
use frontend\widgets\Shop\CartWidget;
use shop\fetching\Shop\CategoryFetchingRepository;
use shop\services\manage\Shop\ProductManageService;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\Feedback\CallMe;

AppAsset::register($this);
\frontend\assets\OwlCarouselAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
<meta name="google-site-verification" content="JbCLejAfWRsVcFprWVmrXhEkSodugfqUtKlMm7EZ9zo" />

<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156904863-2"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



  gtag('config', 'UA-156904863-2');

</script>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '3061770487200580');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=3061770487200580&ev=PageView
&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <script src="//code.jivosite.com/widget.js" data-jv-id="S9BdZAF1Yn" async></script>
    <title><?= Html::encode($this->title) ?></title>
</head>
<body>
<?php $this->beginBody() ?>
<header itemscope itemtype="http://schema.org/Store">
    <meta itemprop="name" content="Manufacture17"/>
    <div class="logo col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <a href="<?= Html::encode(Yii::$app->homeUrl) ?>">
            <img itemprop="image" src="/uploads/logo/Manufacture-2.png" alt="Manufacture17">
        </a>
        <p itemprop="description"><?= Yii::t('app', 'Интернет-магазин тканей') ?></p>
    </div>

    <div class="sub-header col-xs-12 col-sm-8 col-md-8 col-lg-8">

        <div class="sub-header__top">

            <nav class="sub-header__top_social">
                <ul>
                    <li>
                        <a href="https://instagram.com/manufacture17?utm_source=ig_profile_share&igshid=s4qil1gquvo0" target="_blank">
                            <img src="/uploads/social_icons/instagram.png" alt="Instagram">
                        </a>
                    </li>
                    <li>
                        <a href="https://facebook.com/groups/436132426860864?group_view_referrer=profile_browser" target="_blank">
                            <img src="/uploads/social_icons/facebook.png" alt="Facebook">
                        </a>
                    </li>
                    <li>
                        <a href="https://www.pinterest.com/manufacture17" target="_blank">
                            <img src="/uploads/social_icons/pinterest.png" alt="Pinterest">
                        </a>
                    </li>
                </ul>
            </nav>

        </div>

        <div class="sub-header__middle">

            <div class="sub-header__middle_actions" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <p itemprop="streetAddress" class="street"><?= Yii::t('app', 'ул. Вячеслава Липинского (бывш. Ширшова), 18') ?></p>
                <p itemprop="addressLocality" class="city-and-postcode"><?= Yii::t('app', 'Днепр 49000') ?></p>
                <span class="sub-header__phones">
                    <a href="tel:+380965661819" itemprop="telephone" content="+380965661819">+38 (096) 566-18-19</a>
                    <a href="tel:+380660395100" itemprop="telephone" content="+380660395100">+38 (066) 039-51-00</a>
                </span>
                <div type="button" class="glow-on-hover" data-toggle="modal" data-target="#myModal">
                    <div class="text-call">
                        <i class="fa fa-phone"></i>
                        <span><?= Yii::t('app', 'Заказать<br>звонок') ?></span>
                    </div>
                </div>
                <div class="sub-header__middle_actions_search">
                    <?= Html::beginForm(['/shop/catalog/search'], 'get', ['class' => 'woocommerce-product-search']) ?>
                        <label class="screen-reader-text" for="woocommerce-product-search-field-0"><?= Yii::t('app', 'Искать:') ?></label>
                        <input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="<?= Yii::t('app', 'Поиск по товарам…') ?>" value="" name="text">
                        <button type="submit" value="<?= Yii::t('app', 'Поиск') ?>"></button>
                    <?= Html::endForm() ?>
                </div>
            </div>

            <div class="sub-header__middle_user">

                <div class="sub-header__middle_user_cart">
                    <?= CartWidget::widget() ?>
                </div>
                <div class="sub-header__middle_user_cabinet">
                    <a href="/cabinet">
                        <i class="fas fa-user-circle"></i> <?= Yii::t('app', 'Личный кабинет') ?>
                    </a>
                </div>

            </div>

        </div>

    </div>

    <div class="main-nav">
        <?php
        NavBar::begin([
            'options' => [
                'screenReaderToggleText' => 'Menu',
                'id' => 'menu',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'nav navbar-nav navbar navbar-expand-lg navbar-light bg-light'],
            'activateParents'=>true,
            'items' => [
                ['label' => Yii::t('app', 'Главная'), 'url' => ['/site/index']],
                ['label' => Yii::t('app', 'Каталог'), 'url' => ['/shop/catalog/index'],
                    'items' => CategoryFetchingRepository::getMenuTreeStructure(),
                ],
                ['label' => Yii::t('app', 'Новинки'), 'url' => ['/shop/catalog/newest']],
                ['label' => Yii::t('app', 'Распродажа'), 'url' => ['/shop/catalog/sale']],
                ['label' => Yii::t('app', 'Блог'), 'url' => ['/blog/post/index']],
                ['label' => Yii::t('app', 'Контакты'), 'url' => ['/contact/index']],
            ],
        ]);
        NavBar::end();
        ?>
    </div>
</header>

<main>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => ['class' => 'breadcrumb', 'style' => 'padding: 8px 30px']
    ]); ?>
    <?= Alert::widget() ?>

    <?= $content ?>

</main>

<footer>

    <div class="col-12 footer-top">

        <div class="footer-top_categories col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <h3><?= Yii::t('app', 'Категории товаров') ?></h3>
            <ul>
                <li><a href="<?= Html::encode(Url::to('/shop/catalog/index')); ?>"><?= Yii::t('app', 'Каталог тканей') ?></a></li>
                <li><a href="<?= Html::encode(Url::to('/shop/catalog/newest')); ?>"><?= Yii::t('app', 'Новинки') ?></a></li>
                <li><a href="<?= Html::encode(Url::to('/shop/catalog/sale')); ?>"><?= Yii::t('app', 'Распродажа') ?></a></li>
                <li><a href="<?= Html::encode(Url::to('/page/samples')); ?>"><?= Yii::t('app', 'Заказ образцов') ?></a></li>
            </ul>
        </div>

        <div class="footer-top_info col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <h3><?= Yii::t('app', 'Информация') ?></h3>
            <ul>
                <li><a href="<?= Html::encode(Url::to('/terms')); ?>"><?= Yii::t('app', 'Оплата и доставка') ?></a></li>
                <li><a href="<?= Html::encode(Url::to('/disclaimer')); ?>"><?= Yii::t('app', 'Пользовательское соглашение') ?></a></li>
                <li><a href="<?= Html::encode(Url::to('/rights')); ?>"><?= Yii::t('app', 'Авторские права') ?></a></li>
                <li><a href="<?= Html::encode(Url::to('/contact')); ?>"><?= Yii::t('app', 'Контакты') ?></a></li>
                <li><a href="<?= Html::encode(Url::to('/return-and-exchange')); ?>"><?= Yii::t('app', 'Возврат и обмен') ?></a></li>
            </ul>
        </div>

        <div class="footer-top_address col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <h3><?= Yii::t('app', 'Контакты') ?></h3>

            <h4><?= Yii::t('app', 'Наш адрес:') ?></h4>
            <p class="city-and-postcode"><?= Yii::t('app', 'Днепр 49027') ?></p>
            <p class="street"><?= Yii::t('app', 'ул. Вячеслава Липинского (бывш. Ширшова), 18') ?></p>

            <h4><?= Yii::t('app', 'Телефон:') ?></h4>
            <div class="footer-top_phones">

                <p><a href="tel:+380965661819">+38 (096) 566-18-19</a></p>
                <p><a href="tel:+380660395100">+38 (066) 039-51-00</a></p>

            </div>
        </div>

    </div>
    <div class="footer-bottom">

        <div class="footer-bottom_logo col-xs-12 col-sm-6 col-md-2 col-lg-2">
            <a href="/">
                <img src="/uploads/logo/Manufacture-2-300x98.png" alt="Manufacture17 footer logo">
            </a>
        </div>

        <div class="footer-bottom_copyright col-xs-12 col-sm-6 col-md-3">
            <p>&copy; Manufacture17 2018 - <?php echo date('Y'); ?></p>
        </div>

        <div class="footer-bottom_dev-cont">
            <noindex>
                <p><?= Yii::t('app', 'Разработка') ?> &raquo; <a href="tel:+380980630974" rel="nofollow" title="<?= Yii::t('app', 'Позвоните для заказа сайта') ?>"><?= Yii::t('app', 'Александр Степанов') ?></a></p>
            </noindex>
        </div>

    </div>

</footer>

<?= CallMe::widget(); ?>

<?php $this->endBody() ?>

<script type="text/javascript">
$(document).ready(function() {
    $('body').ihavecookies({
        title: "&#x1F36A; <?= Yii::t('app', 'Разрешить сайту принимать Cookie?')?>",
        message: "<?= Yii::t('app', 'Мы используем файлы cookie для того, чтобы предоставить вам больше возможностей при использовании сайта.') ?>",
        delay: 600,
        expires: 1,
        link: '#privacy',
        onAccept: function(){
            var myPreferences = $.fn.ihavecookies.cookie();
            console.log('Yay! The following preferences were saved...');
            console.log(myPreferences);
        },
        // uncheckBoxes: true,
        acceptBtnLabel: '<?= Yii::t('app', 'Соглашаюсь') ?>',
        advancedBtnLabel: '<?= Yii::t('app', 'Отказываюсь') ?>',
        moreInfoLabel: ' ',
        // cookieTypesTitle: 'Выберите, файлы куки которые хотите принимать:',
        // fixedCookieTypeLabel: 'Основное',
        // fixedCookieTypeDesc: 'These are essential for the website to work correctly.'
    });

    // if ($.fn.ihavecookies.preference('marketing') === true) {
    //     console.log('This should run because marketing is accepted.');
    // }
});
</script>

</body>
</html>
<?php $this->endPage() ?>
