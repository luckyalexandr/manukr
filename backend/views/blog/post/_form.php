<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 23:42
 */

use mihaildev\elfinder\ElFinder;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Blog\Post\PostForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="form-wrapper">
        <div class="tabs">
            <span class="tab">Рус</span>
            <span class="tab">Укр</span>
        </div>
        <div class="tab_content">
            <div class="tab_item">

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-default">
                            <div class="box-header with-border">Общее</div>
                            <div class="box-body">
                                <?= $form->field($model, 'categoryId')->dropDownList($model->categoriesList(), ['prompt' => '']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-default">
                            <div class="box-header with-border">Теги</div>
                            <div class="box-body">
                                <?= $form->field($model->tags, 'existing')->checkboxList($model->tags->tagsList()) ?>
                                <?= $form->field($model->tags, 'textNew')->textInput() ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-body">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
                        <?= $form->field($model, 'content')->widget(CKEditor::class, [
                            'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '@webroot/ckedit']),
                        ]) ?>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border">Фото</div>
                    <div class="box-body">
                        <?= $form->field($model, 'photo')->label(false)->widget(FileInput::class, [
                            'options' => [
                                'accept' => 'image/*',
                            ]
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
                    <div class="box-header with-border">Общее uk</div>
                    <div class="box-body">
                        <?= $form->field($model, 'title_uk')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'description_uk')->textarea(['rows' => 3]) ?>
                        <?= $form->field($model, 'content_uk')->widget(CKEditor::class, [
                            'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '@webroot/ckedit']),
                        ]) ?>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border">SEO uk</div>
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
