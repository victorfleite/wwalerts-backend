<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <div class="alert alert-info">
	<p><strong><i class='fa fa-book'></i> <?php echo \Yii::t('translation', 'risk.documentation'); ?></strong></p>
    </div>

    <?php $form = ActiveForm::begin(['layout' => 'default']); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
	<div class="col-lg-3">
	    <?=
	    $form->field($model, 'name_i18n')->widget('\common\components\widgets\inputmodal_i18n\InputModalI18n', [
		'button_modal_label' => \Yii::t('translation', 'translation'),
		'fieldType' => 'text',
		'options' => [
		//'rows' => 6
		]
	    ]);
	    ?>
	</div><!-- /.col-lg-3 -->

	<div class="col-lg-2">
	    <?=
	    $form->field($model, 'color')->widget('\kartik\widgets\ColorInput', []);
	    ?>
	</div><!-- /.col-lg-3 -->

	<div class="col-lg-3">
	    <?=
	    $form->field($model, 'description_i18n')->widget('\common\components\widgets\inputmodal_i18n\InputModalI18n', [
		'button_modal_label' => \Yii::t('translation', 'translation'),
		'fieldType' => 'textarea',
		'options' => [
		    'rows' => 6
		]
	    ]);
	    ?>
	</div><!-- /.col-lg-3 -->
	<div class="col-lg-2">
	    <?= $form->field($model, 'code')->textInput(); ?>
	</div><!-- /.col-lg-2 -->

	<div class="col-lg-2">
	    <?= $form->field($model, 'status')->dropDownList(webapp\modules\risk\models\Risk::getStatusCombo()); ?>
	</div><!-- /.col-lg-2 -->

	
    </div><!-- /.row -->


    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
