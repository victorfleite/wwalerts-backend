<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Workgroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workgroup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')
	    ->textArea(['rows' => '6']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
