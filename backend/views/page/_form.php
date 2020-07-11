<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.02.19
 * Time: 8:16
 */

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\PageForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-wrapper">
        <div class="tabs">
            <span class="tab">Рус</span>
            <span class="tab">Укр</span>
        </div>
        <div class="tab_content">
            <div class="tab_item">
                <div class="box box-default">
                    <div class="box-header with-border">Common</div>
                    <div class="box-body">
                        <?= $form->field($model, 'parentId')->dropDownList($model->parentsList()) ?>
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'content')->widget(CKEditor::class, [
                            'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '@webroot/ckedit/page']),
                        ]) ?>

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
                    <div class="box-header with-border">Common ukr</div>
                    <div class="box-body">
                        <?= $form->field($model, 'title_uk')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'slug_uk')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'content_uk')->widget(CKEditor::class, [
                            'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '@webroot/ckedit/page_uk']),
                        ]) ?>

                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border">SEO ukr</div>
                    <div class="box-body">
                        <?= $form->field($model->meta, 'title_uk')->textInput() ?>
                        <?= $form->field($model->meta, 'description_uk')->textarea(['rows' => 2]) ?>
                        <?= $form->field($model->meta, 'keywords_uk')->textInput() ?>
                    </div>
                </div>
            </div>
        </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
