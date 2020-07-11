<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.01.19
 * Time: 8:44
 */

use kartik\widgets\FileInput;
use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Value;
use shop\helpers\PriceHelper;
use shop\helpers\ProductHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $product \shop\entities\Shop\Product\Product */
/* @var $photosForm \shop\forms\manage\Shop\Product\PhotosForm */
/* @var $modificationsProvider \yii\data\ActiveDataProvider */

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
        <?php if ($product->isActive()): ?>
            <?= Html::a('Draft', ['draft', 'id' => $product->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Activate', ['activate', 'id' => $product->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Редактировать', ['update', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $product->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить выбранный элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Общая информация</div>
                <div class="box-body">

                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'status',
                                'value' => ProductHelper::statusLabel($product->status),
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'brand_id',
                                'value' => ArrayHelper::getValue($product, 'brand.name'),
                            ],
                            'code',
                            'name',
                            'name_uk',
                            [
                                'attribute' => 'category_id',
                                'value' => ArrayHelper::getValue($product, 'category.name'),
                            ],
                            [
                                'label' => 'Прочие категории',
                                'value' => implode(', ', ArrayHelper::getColumn($product->categories, 'name')),
                            ],
                            [
                                'label' => 'Теги',
                                'value' => implode(', ', ArrayHelper::getColumn($product->tags, 'name')),
                            ],
                            'quantity',
                            [
                                'attribute' => 'price_new',
                                'value' => PriceHelper::format($product->price_new),
                            ],
                            [
                                'attribute' => 'price_old',
                                'value' => PriceHelper::format($product->price_old),
                            ],
                            [
                                'attribute' => 'price_min',
                                'value' => PriceHelper::format($product->price_min),
                            ],
                            [
                                'attribute' => 'price_roll',
                                'value' => PriceHelper::format($product->price_roll),
                            ],
                            'min_long',
                            'roll_long',
                            'created_at:datetime',
                            'updated_at:datetime',
                        ],
                    ]) ?>
                    <br />
                    <p>
                        <?= Html::a('Изменить цену', ['price', 'id' => $product->id], ['class' => ['btn btn-primary']]) ?>                        <?php if ($product->canChangeQuantity()): ?>
                            <?= Html::a('Изменить количество', ['quantity', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
                        <?php endif; ?>
                        <?= Html::a('Изменить опт размеры', ['longitude', 'id' => $product->id], ['class' => ['btn btn-primary']]) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="box box-default">
                <div class="box-header with-border">Характеристики</div>
                <div class="box-body">


                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => array_map(function (Value $value) {
                            return [
                                'label' => $value->characteristic->name,
                                'value' => $value->value,
                            ];
                        }, $product->values),
                    ]) ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">Описание</div>
                <div class="box-body">
                    <?= Yii::$app->formatter->asNtext($product->description) ?>
                    <?= Yii::$app->formatter->asNtext($product->description_uk) ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">SEO</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => [
                            [
                                'attribute' => 'meta.title',
                                'value' => $product->meta->title,
                            ],
                            [
                                'attribute' => 'meta.description',
                                'value' => $product->meta->description,
                            ],
                            [
                                'attribute' => 'meta.keywords',
                                'value' => $product->meta->keywords,
                            ],
                        ],
                    ]); ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">SEO uk</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => [
                            [
                                'attribute' => 'meta.title_uk',
                                'value' => $product->meta->title_uk,
                            ],
                            [
                                'attribute' => 'meta.description_uk',
                                'value' => $product->meta->description_uk,
                            ],
                            [
                                'attribute' => 'meta.keywords_uk',
                                'value' => $product->meta->keywords_uk,
                            ],
                        ],
                    ]); ?>
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <div class="box" id="photos">
                <div class="box-header with-border">Фотографии</div>
                <div class="box-body">
                    <div class="row">
                        <?php foreach ($product->photos as $photo): ?>                    <div class="col-md-2 col-xs-3" style="text-align: center">
                            <div class="btn-group">
                                <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', ['move-photo-up', 'id' => $product->id, 'photo_id' => $photo->id], [
                                    'class' => 'btn btn-default',
                                    'data-method' => 'post',
                                ]); ?>
                                <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-photo', 'id' => $product->id, 'photo_id' => $photo->id], [
                                    'class' => 'btn btn-default',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Remove photo?',
                                ]); ?>
                                <?= Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', ['move-photo-down', 'id' => $product->id, 'photo_id' => $photo->id], [
                                    'class' => 'btn btn-default',
                                    'data-method' => 'post',
                                ]); ?>
                            </div>
                            <div>
                                <?= Html::a(
                                    Html::img($photo->getThumbFileUrl('file', 'small')),
                                    $photo->getUploadedFileUrl('file'),
                                    ['class' => 'thumbnail', 'target' => '_blank']
                                ) ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>


                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype'=>'multipart/form-data'],
                    ]); ?>

                    <?= $form->field($photosForm, 'files[]')->label(false)->widget(FileInput::class, [
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => true,
                        ]
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Загрузить фотографии', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
