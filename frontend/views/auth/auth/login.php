<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('login', 'Вход');

$this->registerMetaTag(['name' => 'title', 'content' => Yii::t('login', 'Вход на сайт')]);
$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('login', 'Страница авторизации сайта Manufacture17')]);
$this->registerMetaTag(['name' => 'keywords', 'content' => Yii::t('login', 'вход, логин, авторизация')]);

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="сol-xs-12 site-login">

    <div class="container">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <div class="col-md-6">
            <p><?= Yii::t('login', 'Пожалуйста заполните поля входа:') ?></p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('login', 'Имя пользователя')) ?>

            <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('login', 'Пароль')) ?>

            <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('login', 'Запомнить меня')) ?>

            <div style="color:#999; margin:1em 0">
                <?= Yii::t('login', 'Если вы забыли пароль вы можете') ?> <?= Html::a(Yii::t('login', 'восстановить его'), ['/auth/reset/request']) ?>.
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('login', 'Войти'), ['class' => 'btn btn-4', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6">

<!--            <h2>Вход через соц. сети</h2>-->
<!--            <?//= \yii\authclient\widgets\AuthChoice::widget([
//                'baseAuthUrl' => ['auth/network/auth']
//            ]); ?>-->

        </div>
        <div class="col-md-12">
            <p><?= Yii::t('login', 'Или') ?> <?= Html::a(Yii::t('login', 'зарегистрируйтесь'), \yii\helpers\Url::to('/auth/signup/request')) ?></p>
        </div>

    </div>
</div>
