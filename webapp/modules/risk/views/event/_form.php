<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Util;
use webapp\modules\risk\models\EventType;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <div class="alert alert-info">
	<p><strong><i class='fa fa-book'></i> <?php echo \Yii::t('translation', 'event.documentation'); ?></strong></p>
    </div>


    <?php $form = ActiveForm::begin(['layout' => 'default', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
	<div class="col-lg-6">
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
	    <?= $form->field($model, 'status')->dropDownList(webapp\modules\risk\models\Risk::getStatusCombo()); ?>
	</div><!-- /.col-lg-2 -->

    </div>
    <div class="row">	
	<div class="col-lg-6">
	    <?= $form->field($model, 'code')->textInput(); ?>
	</div><!-- /.col-lg-2 -->
	<div class="col-lg-6">
	    <?php
	    $eventsType = EventType::getTranslatedComboArray('id', 'name_i18n', ['status'=> EventType::STATUS_ACTIVE]);
	    echo $form->field($model, 'event_type_id')->dropDownList($eventsType, ['prompt' => '']);
	    ?>

	</div><!-- /.col-lg-2 -->

    </div><!-- /.row -->

    <div class="row">
	<div class="col-lg-12">
	    <?php
	    $label = \Yii::t('translation', 'event.icon_path');
	    $label .= (!$model->isNewRecord) ? '  [ ' . Html::a(Util::fileRemovePath($model->icon_path), $model->icon_path, $options = ['target' => '_blank']) . ' ]' : '';

	    echo $form->field($model, 'imageFile')->label($label)->widget(FileInput::classname(), [
		'options' => ['accept' => 'image/*'],
		'pluginOptions' => ['allowedFileExtensions' => ['png'], 'showUpload' => false,],
	    ]);
	    ?>
	</div>

    </div><!-- /.row -->

    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
