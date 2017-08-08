<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-form">

    <div class="alert alert-info">
	<p><strong><i class='fa fa-book'></i> <?php echo \Yii::t('translation', 'group.documentation'); ?></strong></p>
    </div>


    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>
    
    <div class="row">
	<div class="col-lg-4">
	    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-6">
	    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-2">
	    <?= $form->field($model, 'status')->dropDownList(webapp\modules\communication\models\Group::getStatusCombo()); ?>
	</div><!-- /.col-lg-2 -->

    </div><!-- /.row -->


    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
