<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 06.02.19
 * Time: 23:45
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>
<div class="col-xs-12">
<div class="container">
    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>
    <aside id="column-right" class="col-sm-3">
        <div class="list-group">
            <?php if (Yii::$app->user->isGuest): ?>
            <a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>" class="list-group-item"><?= Yii::t('cabinet', 'Войти') ?></a>
            <a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>" class="list-group-item"><?= Yii::t('cabinet', 'Зарегистрироваться') ?></a>
                <a href="<?= Html::encode(Url::to(['/auth/reset/request'])) ?>" class="list-group-item"><?= Yii::t('cabinet', 'Забыли пароль?') ?></a>
            <?php else: ?>
            <a href="<?= Html::encode(Url::to(['/cabinet/default/index'])) ?>" class="list-group-item"><?= Yii::t('cabinet', 'Мой кабинет') ?></a>
            <a href="<?= Html::encode(Url::to(['/cabinet/wishlist/index'])) ?>" class="list-group-item"><?= Yii::t('cabinet', 'Список желаний') ?></a>
            <a href="<?= Html::encode(Url::to(['/cabinet/order/index'])) ?>" class="list-group-item"><?= Yii::t('cabinet', 'История заказов') ?></a>
            <a href="<?= Html::encode(Url::to(['/logout'])) ?>" class="list-group-item"><?= Yii::t('cabinet', 'Выход') ?></a>
            <?php endif; ?>
        </div>
    </aside>
</div>
</div>
<?php $this->endContent() ?>
