<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 01.02.19
 * Time: 12:02
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<div class="row">
    <div class="col-md-5 hiddem-sm">
        <div class="text-left total-show"><?= Yii::t('shop', 'Показано') ?> <?= $dataProvider->getCount() ?> <?= Yii::t('shop', 'из') ?> <?= $dataProvider->getTotalCount() ?></div>
    </div>
    <div class="col-md-4 col-xs-12">
        <div class="form-group input-group input-group-sm">
            <label class="input-group-addon" for="input-sort"><?= Yii::t('shop', 'Сортировать по:') ?></label>
            <select id="input-sort" class="form-control" onchange="location = this.value;">
                <?php
                $values = [
                    '' => Yii::t('shop', 'По умолчанию'),
                    'name' => Yii::t('shop', 'Наименованию (А - Я)'),
                    '-name' => Yii::t('shop', 'Наименованию (Я - А)'),
                    'price' => Yii::t('shop', 'По возрастанию цены'),
                    '-price' => Yii::t('shop', 'По убыванию цены'),
                    '-rating' => Yii::t('shop', 'Рейтингу (высокий)'),
                    'rating' => Yii::t('shop', 'Рейтингу (низкий)'),
                ];
                $current = Yii::$app->request->get('sort');
                ?>
                <?php foreach ($values as $value => $label): ?>
                    <option value="<?= Html::encode(Url::current(['sort' => $value ?: null])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-3 col-xs-12">
        <div class="form-group input-group input-group-sm">
            <label class="input-group-addon" for="input-limit"><?= Yii::t('shop', 'Отобразить:') ?></label>
            <select id="input-limit" class="form-control" onchange="location = this.value;">
                <?php
                $values = [15, 25, 50, 75, 100];
                $current = $dataProvider->getPagination()->getPageSize();
                ?>
                <?php foreach ($values as $value): ?>
                    <option value="<?= Html::encode(Url::current(['per-page' => $value])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div class="products row">
    <?php foreach ($dataProvider->getModels() as $product): ?>
        <?= $this->render('_product', [
            'product' => $product
        ]) ?>
    <?php endforeach; ?>
</div>

<div class="row">
    <div class="col-sm-12 text-center">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
        ]) ?>
    </div>
</div>