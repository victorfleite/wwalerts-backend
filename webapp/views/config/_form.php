<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(['fieldClass'=>'\common\components\widgets\config\ConfigActiveField']); ?>

    <?= $form->field($model, 'varname')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    
    <?= $form->field($model, 'value')->specificField($model->varname, ['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Salvar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
