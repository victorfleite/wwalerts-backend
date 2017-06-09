<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CountrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gid') ?>

    <?= $form->field($model, 'fips') ?>

    <?= $form->field($model, 'iso2') ?>

    <?= $form->field($model, 'iso3') ?>

    <?= $form->field($model, 'un') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'pop2005') ?>

    <?php // echo $form->field($model, 'region') ?>

    <?php // echo $form->field($model, 'subregion') ?>

    <?php // echo $form->field($model, 'lon') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'geom') ?>

    <?php // echo $form->field($model, 'batch_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('translation', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('translation', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
