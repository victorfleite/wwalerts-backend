<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'state_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'the_geom_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geocode')->textInput() ?>

    <?= $form->field($model, 'geom')->textInput() ?>

    <?= $form->field($model, 'batch_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
