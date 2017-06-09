<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\State */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="state-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'center_lat')->textInput() ?>

    <?= $form->field($model, 'center_lon')->textInput() ?>

    <?= $form->field($model, 'abbreviati')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cd_geocodu')->textInput() ?>

    <?= $form->field($model, 'geom')->textInput() ?>

    <?= $form->field($model, 'batch_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
