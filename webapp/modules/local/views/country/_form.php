<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>
        
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'un')->textInput() ?>

    <?= $form->field($model, 'fips')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iso2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iso3')->textInput(['maxlength' => true]) ?>

   
    <?= $form->field($model, 'area')->textInput() ?>

    <?= $form->field($model, 'pop2005')->textInput() ?>

    <?= $form->field($model, 'region')->textInput() ?>

    <?= $form->field($model, 'subregion')->textInput() ?>

    <?= $form->field($model, 'lon')->textInput() ?>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?=
	    $form->field($model, 'geom')
	    ->label(\Yii::t('translation', 'country.geom') . ' (' . \Yii::t('translation', 'country.geom_hint') . ')')
	    ->textArea(['rows' => '6', 'id' => 'wkt'])
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
