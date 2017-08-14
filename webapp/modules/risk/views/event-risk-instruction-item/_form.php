<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskInstructionItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-risk-instruction-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_risk_instruction_id')->textInput() ?>

    <?= $form->field($model, 'description_i18n')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
