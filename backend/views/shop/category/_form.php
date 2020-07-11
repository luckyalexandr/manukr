<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 11.01.19
 * Time: 22:50
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\Shop\CategoryForm */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="category-form">
    <?php $form = ActiveForm::begin(); ?>

<div class="form-wrapper">
    <div class="tabs">
        <span class="tab">Рус</span>
        <span class="tab">Укр</span>
    </div>

    <div class="tab_content">
        <div class="tab_item">
            <div class="box box-default">
                <div class="box-header width-border">Общая информация</div>
                <div class="box-body">
                    <?= $form->field($model, 'parentId')->dropDownList($model->parentCategoriesList()) ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
                </div>
            </div>

            <div class="box box-default">
                <div class="box-header with-border">SEO</div>
                <div class="box-body">
                    <?= $form->field($model->meta, 'title')->textInput() ?>
                    <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>
                    <?= $form->field($model->meta, 'keywords')->textInput() ?>
                </div>
            </div>
        </div>
        <div class="tab_item">
            <div class="box box-default">
                <div class="box-header width-border">Общая информация</div>
                <div class="box-body">
                    <?= $form->field($model, 'parentId')->dropDownList($model->parentCategoriesList()) ?>
                    <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'slug_uk')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'title_uk')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'description_uk')->textarea(['rows' => 2]) ?>
                </div>
            </div>

            <div class="box box-default">
                <div class="box-header with-border">SEO</div>
                <div class="box-body">
                    <?= $form->field($model->meta, 'title_uk')->textInput() ?>
                    <?= $form->field($model->meta, 'description_uk')->textarea(['rows' => 2]) ?>
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
