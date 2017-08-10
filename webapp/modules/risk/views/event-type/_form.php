<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

	<div class="col-lg-4">
	    <?=
	    $form->field($model, 'name_i18n')->widget('\common\components\widgets\inputmodal_i18n\InputModalI18n', [
		'button_modal_label' => \Yii::t('translation', 'translation'),
		'fieldType' => 'text',
		'options' => [
		//'rows' => 6
		]
	    ]);
	    ?>
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-4">
	    <?=
	    $form->field($model, 'description_i18n')->widget('\common\components\widgets\inputmodal_i18n\InputModalI18n', [
		'button_modal_label' => \Yii::t('translation', 'translation'),
		'fieldType' => 'textarea',
		'options' => [
		    'rows' => 6
		]
	    ]);
	    ?>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-2">
	    <?= $form->field($model, 'abbrev')->textInput(['disabled'=>True]); ?>
	</div><!-- /.col-lg-2 -->
	<div class="col-lg-2">
	    <?= $form->field($model, 'status')->dropDownList(webapp\modules\risk\models\EventType::getStatusCombo()); ?>
	</div><!-- /.col-lg-2 -->
    </div>


    <div class="form-group">
	<?= Html::submitButton(Yii::t('translation', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
