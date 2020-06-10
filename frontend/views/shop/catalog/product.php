<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 01.02.19
 * Time: 15:25
 */

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $cartForm shop\forms\Shop\AddToCartForm */
/* @var $reviewForm shop\forms\Shop\ReviewForm */
/* @var $recommended */

use frontend\assets\MagnificPopupAsset;
use shop\entities\User\User;
use shop\helpers\PriceHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerMetaTag(['name' =>'title', 'content' => $product->meta->title]);
$this->registerMetaTag(['name' =>'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $product->meta->keywords]);

$this->title = $product->name;

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
foreach ($product->category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];
$this->params['breadcrumbs'][] = $product->name;

$this->params['active_category'] = $product->category;

MagnificPopupAsset::register($this);
//$explode = explode(",", $product->meta->keywords);
//var_dump($explode[0]);die();
?>
<div class="container product">
    <div class="row microdata" xmlns:fb="http://www.w3.org/1999/xhtml"  itemscope itemtype="http://schema.org/Product">
        <div class="col-sm-8">
            <ul class="thumbnails">
                <?php foreach ($product->photos as $i => $photo): ?>
                    <?php if ($i == 0): ?>
                        <li>
                            <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>">
                                <img 
                                class="p_photo" 
                                itemprop="image" 
                                src="<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>" 
                                data-large="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>"
                                title="<?= Html::encode($product->name) . ' арт. ' . Html::encode($product->code) ?>"
                                alt="<?= Html::encode($product->name) . ', ' . mb_strtolower(Html::encode($product->meta->keywords)) ?>" />
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="image-additional">
                            <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>">
                                <img itemprop="image" src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>"  title="<?= Html::encode($product->name) . ' арт. ' . Html::encode($product->code) ?>" alt="<?= Html::encode($product->name) . ', ' . mb_strtolower(Html::encode($product->meta->keywords)) ?>" />
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-description" data-toggle="tab">Описание</a></li>
                <li><a href="#tab-specification" data-toggle="tab">Характеристики</a></li>
                <li><a href="#tab-review" data-toggle="tab">Отзывы (<?= count($product->activeReviews) > 0 ? count($product->activeReviews) : 0?>)</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-description"><p itemprop="description">
                        <?= Yii::$app->formatter->asHtml($product->description, [
                            'Attr.AllowedRel' => array('nofollow'),
                            'HTML.SafeObject' => true,
                            'Output.FlashCompat' => true,
                            'HTML.SafeIframe' => true,
                            'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                        ]) ?>
                </div>
                <div class="tab-pane" id="tab-specification">
                    <table class="table table-bordered">
                        <tbody>
                        <?php foreach ($product->values as $value): ?>
                            <?php if ($value->value !== ''): ?>
                                <?php if (count($value->characteristic->variants) > 1): ?>
                                    <tr>
                                        <th><?= Html::encode($value->characteristic->name) ?></th>
                                        <td><?= Html::encode($value->characteristic->variants[$value->value]) ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <th><?= Html::encode($value->characteristic->name) ?></th>
                                        <td><?= Html::encode($value->value) ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="tab-review">
                    <div id="review">
                        <?php foreach ($product->reviews as $review): ?>
                        <?php if ($review->isActive()): ?>
                            <div class="review-item">
                                <p><span><?= User::findOne($review->user_id)->username ?></span></p>
                                <p><?= $review->text ?></p>
                            </div>
                        <?php endif; ?>
                        <?php endforeach; ?></div>
                    <h2>Оставить отзыв</h2>

                        <?php if (Yii::$app->user->isGuest): ?>

                            <div class="panel-panel-info">
                                <div class="panel-body">
                                    Пожалуйста <?= Html::a('Войдите', ['/auth/auth/login']) ?>-->
                                </div>
                            </div>

                        <?php else: ?>

                            <?php $form = ActiveForm::begin(['id' => 'form-review']) ?>

                            <?= $form->field($reviewForm, 'vote')->dropDownList($reviewForm->votesList(), ['prompt' => '--- Выбрать ---'])->label('Оценка') ?>
                            <?= $form->field($reviewForm, 'text')->textarea(['rows' => 5])->label('Отзыв') ?>

                            <div class="form-group">
                                <?= Html::submitButton('Отправить', ['class' => 'btn btn-4 btn-lg btn-block']) ?>
                            </div>

                            <?php ActiveForm::end() ?>

                        <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4 product-details">
            <p class="btn-group">
                <a data-toggle="tooltip" class="btn btn-default" title="Добавить в список желаний" href="<?= Url::to(['/cabinet/wishlist/add', 'id' => $product->id]) ?>" data-method="post"><i class="fa fa-heart"></i></a>
            </p>
            <h1 itemprop="name"><?= Html::encode($product->name) ?></h1>
            <ul class="list-info">
                <li>
                    <p>
                        Бренд: <a itemprop="brand" href="<?= Html::encode(Url::to(['brand', 'id' => $product->brand->id])) ?>"><?= Html::encode($product->brand->name) ?></a>
                    </p>
                </li>
                <li>
                    <p>
                        Теги:
                        <?php foreach ($product->tags as $tag): ?>
                            <a href="<?= Html::encode(Url::to(['tag', 'id' => $tag->id])) ?>"><?= Html::encode($tag->name) ?></a>,
                        <?php endforeach; ?>
                    </p>
                </li>
                <li>
                    <p>
                        Артикул: <span itemprop="code"><?= Html::encode($product->code) ?></span>
                    </p>
                </li>
                <li>
                	<p>
                		В наличии
                	</p>
                </li>
            </ul>
            <ul class="list-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <meta itemprop="priceCurrency" content="UAH"/>
                <meta itemprop="price" content="<?= PriceHelper::format($product->price_new) ?>"/>
                <link itemprop="availability" href="http://schema.org/InStock" />
                <meta itemprop="url" content="<?= Html::encode(Url::to(['slug-product', 'slug' => $product->slug], true)); ?>">
                <h2>Цена:</h2>
                <li>
                    <p>От 1 м. <?= PriceHelper::format($product->price_new) ?> грн./п. метр</p>
                </li>
                <?php if ($product->price_min && $product->min_long): ?>
                <li>
                    <p>От <?= $product->min_long ?> м.: <?= $product->price_min ?> грн./п. метр</p>
                </li>
                <?php endif; ?>

                <?php if ($product->roll_long && $product->price_roll): ?>
                    <li>
                        <p>От <?= $product->roll_long ?> м.: <?= $product->price_roll ?> грн./п. метр</p>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="product-variants">

                <?php if ($product->isActive()): ?>

                    <hr>
                    <h3>Детали заказа</h3>

                    <?php $form = ActiveForm::begin([
                    'action' => ['/shop/cart/add', 'id' => $product->id],
                    ]) ?>

                    <?php if ($modifications = $cartForm->modificationsList()): ?>
                        <?= $form->field($cartForm, 'modification')->dropDownList($modifications, ['prompt' => '--- Выбрать модификацию ---']) ?>
                    <?php endif; ?>

                    <?= $form->field($cartForm, 'quantity')->textInput(['type' => 'number']) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Добавить в корзину', ['class' => 'btn btn-4 btn-lg btn-block cartAddFP']) ?>
                        <script type="text/javascript">
                            $('.cartAddFP').click(function() {
                                fbq('track', 'AddToCart');
                            });
                        </script>
                    </div>

                    <?php ActiveForm::end() ?>

                <?php else: ?>

                    <div class="alert alert-danger">
                        В данный момент товар не доступен для заказа.<br />Добавить в свой список желаний.
                    </div>

                <?php endif; ?>

            </div><div class="rating">
                <div class="stars">
                    <div class="on" style="width: <?= 100 / 5 * $product->rating ?>%;"></div>
                    <div class="live">
                        <span data-rate="1"></span>
                        <span data-rate="2"></span>
                        <span data-rate="3"></span>
                        <span data-rate="4"></span>
                        <span data-rate="5"></span>
                    </div>
                </div>
                <div class="percents">
                    <p>Рейтинг: <?= 100 / 5 * $product->rating ?>%</p>
                </div>
            </div>
<!--            <div class="rating">-->
<!--                <div class="on" style="width: 80%;"></div>-->
<!--                <p>-->
<!--                    <span class="fa fa-stack"><i class="far fa-star fa-stack-1x"></i></span>-->
<!--                    <span class="fa fa-stack"><i class="far fa-star fa-stack-1x"></i></span>-->
<!--                    <span class="fa fa-stack"><i class="far fa-star fa-stack-1x"></i></span>-->
<!--                    <span class="fa fa-stack"><i class="far fa-star fa-stack-1x"></i></span>-->
<!--                    <span class="fa fa-stack"><i class="far fa-star fa-stack-1x"></i></span>-->
<!--                </p>-->
<!--            </div>-->
            <div class="product-reviews">
                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?= count($product->activeReviews) > 0 ? count($product->activeReviews) : 0?> отзыва(ов)</a> / <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Добавить отзыв</a>
            </div>
            <hr>
            
        </div>
    </div>
    <section class="recommended">
        <h2>Рекомендованные товары</h2>
        <div class="products row">
            <?= \frontend\widgets\Shop\NewestProductsWidget::widget([
                'limit' => 4,
            ]); ?>
            <?php foreach ($recommended as $i => $item):
                $url = Url::to(['/catalog/' . $item->slug]); ?>
                <div class="col-xs-12 col-sm-6 col-md-3 content-product">
                    <a href="<?= Html::encode($url) ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                        <img src="<?= Html::encode($item->mainPhoto->getThumbFileUrl('file', 'large')) ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="<?= Html::encode($product->name) . ', ' . mb_strtolower(Html::encode($product->meta->keywords)) ?>" width="300" height="300">
                        <div class="product-details-wrapper">
                            <h3 class="loop-product__title"><?= $item->name ?></h3>
                            <span class="price">
                    <span class="price-new">
                        От 1м <?= PriceHelper::format($item->price_new) ?> грн./п.метр
                    <?php if ($item->price_old): ?>
                        <span class="price-old"><?= PriceHelper::format($item->price_old) ?> грн./п.метр</span>
                    <?php endif; ?>
                    </span>

                    <?php if ($item->price_roll): ?>
                        <span class="price-roll">
                            Рулон (<?= $item->roll_long ?>) <?= PriceHelper::format($item->price_roll) ?> грн./п.метр
                        </span>
                    <?php endif; ?>
                        </span>
                        </div>
                    </a>

                    <div class="button-group">
                        <a class="button cartAddFP" href="<?= Url::to(['/shop/cart/add', 'id' => $product->id]) ?>" data-method="post"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">В корзину</span></a>
                        <a class="button" data-toggle="tooltip" title="Добавить в список желаний" href="<?= Url::to(['/cabinet/wishlist/add', 'id' => $product->id]) ?>" data-method="post"><i class="fa fa-heart"></i></a>
                        <script type="text/javascript">
                            $('.cartAddFP').click(function() {
                                fbq('track', 'AddToCart');
                            });
                        </script>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php $js = <<<EOD
$('.thumbnails').magnificPopup({
    type: 'image',
    delegate: 'a',
    gallery: {
        enabled:true
    }
});
EOD;
$this->registerJs($js); ?>