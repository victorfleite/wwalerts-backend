<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Behavior */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="behavior-form">

    <div class="alert alert-info">
	<p><strong><i class='fa fa-book'></i> <?php echo \Yii::t('translation', 'behavior.documentation'); ?></strong></p>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
	<div class="col-lg-4">
	    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-8">
	    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>
	</div><!-- /.col-lg-6 -->	

    </div><!-- /.row -->
    <div class="row">
	<div class="col-lg-12">
	    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>
	</div><!-- /.col-lg-2 -->
    </div><!-- /.row -->
    <div class="row">
	<div class="col-lg-12">
	    <?= $form->field($model, 'params')->textarea(['rows' => 6]); ?>
	</div><!-- /.col-lg-2 -->
    </div><!-- /.row -->

    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
