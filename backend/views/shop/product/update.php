<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.01.19
 * Time: 8:43
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $model shop\forms\manage\Shop\Product\ProductEditForm */

$this->title = 'Редактировать товар: ' . $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="product-update">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

<div class="form-wrapper">
    <div class="tabs">
        <span class="tab">Рус</span>
        <span class="tab">Укр</span>
    </div>

    <div class="tab_content">
        <div class="tab_item">
            <div class="box box-default">
                <div class="box-header with-border">Общая информация</div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'brandId')->dropDownList($model->brandsList()) ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'description')->textarea(['rows' => 10]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-default">
                        <div class="box-header with-border">Категории</div>
                        <div class="box-body">
                            <?= $form->field($model->categories, 'main')->dropDownList($model->categories->categoriesList(), ['prompt' => 'Укажите главную категорию']) ?>
                            <?= $form->field($model->categories, 'others')->checkboxList($model->categories->categoriesList()) ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-default">
                        <div class="box-header with-border">Метки</div>
                        <div class="box-body">
                            <?= $form->field($model->tags, 'existing')->checkboxList($model->tags->tagsList()) ?>
                            <?= $form->field($model->tags, 'textNew')->textInput() ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="box box-default">
                <div class="box-header with-border">Мета теги (SEO)</div>
                <div class="box-body">
                    <?= $form->field($model->meta, 'title')->textInput() ?>
                    <?= $form->field($model->meta, 'description')->textarea(['rows' => 3]) ?>
                    <?= $form->field($model->meta, 'keywords')->textInput() ?>
                </div>
            </div>

            <div class="box box-default">
                <div class="box-header with-border">Характеристики</div>
                <div class="box-body">
                    <?php foreach ($model->values as $i => $value): ?>
                        <?php if ($variants = $value->variantsList()): ?>
                            <?= $form->field($value, '[' . $i . ']value')->dropDownList($variants, ['prompt' => '']) ?>
                        <?php else: ?>
                            <?= $form->field($value, '[' . $i . ']value')->textInput() ?>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="tab_item">
            <div class="box box-default">
                <div class="box-header with-border">Общая информация uk</div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'description_uk')->textarea(['rows' => 10]) ?>
                </div>
            </div>

            <div class="box box-default">
                <div class="box-header with-border">Мета теги (SEO) uk</div>
                <div class="box-body">
                    <?= $form->field($model->meta, 'title_uk')->textInput() ?>
                    <?= $form->field($model->meta, 'description_uk')->textarea(['rows' => 3]) ?>
                    <?= $form->field($model->meta, 'keywords_uk')->textInput() ?>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
