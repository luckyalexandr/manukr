<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 06.02.19
 * Time: 15:30
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $searchForm \shop\forms\Shop\Search\SearchForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('shop', 'Поиск');

$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="panel panel-default">
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get']) ?>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($searchForm, 'text')->textInput()->label(Yii::t('shop', 'Наименование')) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($searchForm, 'category')->dropDownList($searchForm->categoriesList(), ['prompt' => Yii::t('shop', 'Выбрать категорию')])->label(Yii::t('shop', 'Категория')) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($searchForm, 'brand')->dropDownList($searchForm->brandsList(), ['prompt' => Yii::t('shop', 'Выбрать Бренд')])->label(Yii::t('shop', 'Бренд')) ?>
            </div>
        </div>
<h2>
    <?= Yii::t('shop', 'Характеристики') ?>
</h2>
        <?php foreach ($searchForm->values as $i => $value): ?>
            <div class="row">
                <div class="col-md-4">
                    <?= Html::encode($value->getCharacteristicName()) ?>
                </div>
                <?php if ($variants = $value->variantsList()): ?>
                    <div class="col-md-4">
                        <?= $form->field($value, '[' . $i . ']equal')->dropDownList($variants, ['prompt' => ''])->label(false) ?>
                    </div>
                <?php elseif ($value->isAttributeSafe('from') && $value->isAttributeSafe('to')): ?>
                    <div class="col-md-2">
                        <?= $form->field($value, '[' . $i . ']from')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($value, '[' . $i . ']to')->textInput() ?>
                    </div>
                <?php endif ?>
            </div>
        <?php endforeach; ?>

        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton(Yii::t('shop', 'Искать'), ['class' => 'btn btn-4 btn-lg btn-block']) ?>
            </div>
            <div class="col-md-6">
                <?= Html::a(Yii::t('shop', 'Очистить'), [''], ['class' => 'btn btn-4 btn-lg btn-block']) ?>
            </div>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>