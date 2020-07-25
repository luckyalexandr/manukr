<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 5:47
 */


/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */
/* @var $model \shop\forms\Shop\Order\OrderForm */

use kartik\widgets\DepDrop;
use LisDev\Delivery\NovaPoshtaApi2;
use shop\helpers\PriceHelper;
use shop\helpers\WeightHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$this->title = Yii::t('shop', 'Оформление заказа');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Каталог'), 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop', 'Корзина'), 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;
//var_dump($model->delivery->getNp());die();
?>
<script>
    fbq('track', 'Purchase');
</script>
<div class="checkout-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="table-responsive">
            <table class="table table-bordered rwd-table">
                <tr>
                    <th class="text-left"><?= Yii::t('shop', 'Наименование') ?></th>
                    <th class="text-left"><?= Yii::t('shop', 'Модель') ?></th>
                    <th class="text-left"><?= Yii::t('shop', 'Количество') ?></th>
                    <th class="text-right"><?= Yii::t('shop', 'Цена за 1 м.') ?></th>
                    <th class="text-right"><?= Yii::t('shop', 'Итого') ?></th>
                </tr>
                <?php foreach ($cart->getItems() as $item): ?>
                    <?php
                    $product = $item->getProduct();
                    $modification = $item->getModification();
                    $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                    ?>
                    <tr>
                        <td class="text-left">
                            <a href="<?= $url ?>"><?= Html::encode(Yii::$app->language == 'ru' ? $product->name : $product->name_uk) ?></a>
                        </td>
                        <td data-th="Модель:" class="text-left">
                            <?php if ($modification): ?>
                                <?= Html::encode($modification->name) ?>
                            <?php endif; ?>
                        </td>
                        <td data-th="Количество:" class="text-left">
                            <?= $item->getQuantity() ?>
                        </td>
                        <td data-th="Цена за 1 м.:" class="text-right"><?= PriceHelper::format($item->getPrice()) ?></td>
                        <td data-th="Итого:" class="text-right"><?= PriceHelper::format($item->getCost()) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <br />

        <?php $cost = $cart->getCost() ?>
        <table class="table table-bordered">
            <tr>
                <td class="text-right"><strong><?= Yii::t('shop', 'Подитог:') ?></strong></td>
                <td class="text-right"><?= PriceHelper::format($cost->getOrigin()) ?> грн.</td>
            </tr>
            <tr>
                <td class="text-right"><strong><?= Yii::t('shop', 'Итого:') ?></strong></td>
                <td class="text-right"><?= PriceHelper::format($cost->getTotal()) ?> грн.</td>
            </tr>
        </table>

        <?php $form = ActiveForm::begin() ?>

        <div class="panel panel-default">
            <div class="panel-heading"><?= Yii::t('shop', 'Данные получателя') ?></div>
            <div class="panel-body">
                <?= $form->field($model->customer, 'phone')->widget(MaskedInput::class, [
                    'mask' => '+38 (999) 999-99-99',
                    'options' => [
                        'class' => 'form-control placeholder-style',
                    ],
                ])->label(Yii::t('shop', 'Телефон')) ?>
                <?= $form->field($model->customer, 'name')->textInput()->label(Yii::t('shop', 'ФИО')) ?>
                <?= $form->field($model->customer, 'email')->textInput()->label(Yii::t('shop', 'Email')) ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><?= Yii::t('shop', 'Информация о доставке') ?></div>
            <div class="panel-body">
                <div class="sber">
                    <p class="sber-requisites">
                        <strong>
                            <?= Yii::t('shop', 'Реквизиты для оплаты') ?>
                        </strong>
                    </p>
                    <p><strong><?= Yii::t('shop', 'МФО') ?></strong> 305482</p>
                    <p><strong><?= Yii::t('shop', 'ИНН') ?></strong> 3220303487</p>
                    <p><strong><?= Yii::t('shop', 'Счет') ?></strong> UA493054820000026009500736774</p>
                    <p><?= Yii::t('shop', 'Поляруш Дарина Валериевна.') ?></p>
                </div>
                <?= $form->field($model->delivery, 'method')->dropDownList($model->delivery->deliveryMethodsList(), ['prompt' => Yii::t('shop', '--- Выбрать метод доставки ---'), 'required' => true])->label(Yii::t('shop', 'Способ доставки')) ?>
                <?= $form->field($model->delivery, 'address')->textarea(['rows' => 3])->label(Yii::t('shop', 'Адрес')) ?>

                <?= $form->field($model->delivery, 'area')->dropDownList(ArrayHelper::getColumn($model->delivery->getAreas(), 'Description'),
                    [
                        'prompt' => Yii::t('shop', 'Выберите область'),
                        'onchange' => '
                        $.post(
                            "'.Url::toRoute('cities').'",
                            {area : $(this).val()},
                            function(data){
                                $("select#deliveryform-city").html(data).attr("disabled", false)
                            }
                        )
                    '
                    ]) ?>

                <?= $form->field($model->delivery, 'city')->dropDownList([],
                    [
                        'prompt' => Yii::t('shop', 'Сначала выберите область'),
                        'area' => 'area',
                        'onchange' => '
                        $.post(
                            "'.Url::toRoute('warehouses').'",
                            {city : $(this).val()},
                            function(data){
                                $("select#deliveryform-warehouse").html(data).attr("disabled", false)
                            }
                        )
                    ',
                        'disabled' => 'disabled'
                    ]) ?>

                <?= $form->field($model->delivery, 'warehouse')->dropDownList(array(),
                    [
                        'prompt' => Yii::t('shop', 'Сначала выберите город'),
                        'city' => 'city',
                        'disabled' => 'disabled'
                    ]); ?>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><?= Yii::t('shop', 'Примечание к заказу') ?></div>
            <div class="panel-body">
                <?= $form->field($model, 'note')->textarea(['rows' => 3])->label(false) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('shop', 'Подтвердить'), ['class' => 'btn btn-4']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>

