<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="user-search">

    <?php
    $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
    ]);
    ?>

    <?php
    echo Form::widget([// 1 column layout
	'model' => $model,
	'form' => $form,
	'columns' => 4,
	'attributes' => [
	    'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'user.name')]],
	    'username' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'user.username')]],
	    'email' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'user.email')]],
	    'status' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => User::getStatusCombo(),
		'options' => [
		    'prompt' => ''
		]],
	]
    ]);
    ?>


    <div class="form-group">
	<?= Html::submitButton(Yii::t('translation', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
