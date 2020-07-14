<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 5:47
 */


/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('shop', 'Заказ принят');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Каталог'), 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Корзина'), 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    fbq('track', 'Purchase');
</script>
<div class="checkout-finish">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><b><?= Yii::t('shop', 'Благодарим за покупку. Ваш заказ обрабатывается.') ?></b></p>

    </div>
</div>

