<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('translation', 'site.login.title');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container">
    <div class="card card-container">
	<h1><?= Html::encode($this->title) ?></h1>
	<p id="profile-name" class="profile-name-card"></p>
	<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
	<span id="reauth-email" class="reauth-email"></span>
	<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
	<?= $form->field($model, 'password')->passwordInput() ?>

	<?= Html::submitButton(Yii::t('translation', 'site.login.form_login.btn_login'), ['class' => 'btn btn-lg btn-primary btn-block btn-signin', 'name' => 'login-button']) ?>
	<?php ActiveForm::end(); ?>
	<a href="<?= Url::to(['site/request-password-reset']) ?>" class="forgot-password">
	    <?php echo Yii::t('translation', 'site.login.form_login.reset_password_label'); ?>
	</a>
    </div><!-- /card-container -->
</div><!-- /container -->
