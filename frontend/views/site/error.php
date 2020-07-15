
<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <?php if ($exception->statusCode == 404): ?>

        <div class="error-page">
            <div>

                <h1 data-h1="404">404</h1>
                <p data-p="NOT FOUND"><?= Yii::t('app', 'СТРАНИЦА НЕ НАЙДЕНА') ?></p>

            </div>
        </div>
        <div id="particles-js"></div>

    <?php else: ?>


        <h1><?= Html::encode($this->title) ?></h1>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
            <?= Yii::t('app', 'Вышеуказанная ошибка произошла, когда веб-сервер обрабатывал ваш запрос.') ?>
        </p>
        <p>
            <?= Yii::t('app', 'Пожалуйста, свяжитесь с нами, если считаете, что это ошибка сервера. Спасибо.') ?>
        </p>

    <?php endif; ?>
</div>