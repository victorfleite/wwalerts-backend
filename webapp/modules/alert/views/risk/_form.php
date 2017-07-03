<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(['layout' => 'default', 'fieldClass'=>'\common\components\widgets\config\ConfigActiveField']); ?>
      
    <?= $form->field($model, 'name_i18n')->inputWithModalI18n(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'color')->colorPickerInput(['maxlength' => true, 'readonly' => true]) ?>
  
    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
