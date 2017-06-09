<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gid') ?>

    <?= $form->field($model, 'latitude') ?>

    <?= $form->field($model, 'longitude') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'state_id') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'the_geom_s') ?>

    <?php // echo $form->field($model, 'geocode') ?>

    <?php // echo $form->field($model, 'geom') ?>

    <?php // echo $form->field($model, 'batch_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('translation', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('translation', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
