<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Institution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="institution-form">

    <?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'abbreviation')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abbreviation_cap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sender_cap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_cap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'language_cap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
