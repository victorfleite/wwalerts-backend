<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="state-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'country_id') ?>

    <?= $form->field($model, 'center_lat') ?>

    <?= $form->field($model, 'center_lon') ?>

    <?php // echo $form->field($model, 'abbreviati') ?>

    <?php // echo $form->field($model, 'icon_path') ?>

    <?php // echo $form->field($model, 'cd_geocodu') ?>

    <?php // echo $form->field($model, 'geom') ?>

    <?php // echo $form->field($model, 'batch_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('translation', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('translation', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
