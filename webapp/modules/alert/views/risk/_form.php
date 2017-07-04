<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(['layout' => 'default', 'fieldClass' => '\common\components\widgets\ActiveField']); ?>


    <div class="row">
	<div class="col-lg-6">
	    <?= $form->field($model, 'name_i18n')->inputWithModalI18n(['maxlength' => true]) ?>
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6">
	    <?= $form->field($model, 'color')->colorPickerInput(['maxlength' => true]) ?>
	</div><!-- /.col-lg-6 -->
    </div><!-- /.row -->


    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
