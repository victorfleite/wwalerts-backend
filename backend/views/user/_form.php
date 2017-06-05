<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="row">
        <div class="col-lg-5">
	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'name')->textInput() ?>

	    <?= $form->field($model, 'username')->textInput() ?>

	    <?= $form->field($model, 'email')->textInput() ?>


	    <?=
		    $form->field($model, 'status')
		    ->dropDownList(
			    User::getStatusCombo(), ['prompt' => '']    // options
	    );
	    ?>

	    <div class="form-group">
		<?= Html::submitButton(Yii::t('translation', 'user.btn_update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>
	</div>
    </div>

</div>
