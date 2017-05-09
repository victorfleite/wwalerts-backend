<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
	<?= Yii::t('translation', 'site.reset_password.email_html', ['username'=>Html::encode($user->username), 'link'=>Html::a(Html::encode($resetLink), $resetLink)]) ?>   
</div>
