<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskInstructionItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-risk-instruction-item-form">

    <div class="alert alert-info">
	<p><strong><i class='fa fa-book'></i> <?php echo \Yii::t('translation', 'event_risk_instruction_item.documentation'); ?></strong></p>
    </div>

    <h3><?php echo \Yii::t('translation', 'event_risk_instruction'); ?></h3>

    <?=
    DetailView::widget([
	'model' => $eventRiskInstruction,
	'attributes' => [
	    //'id',
	   [
		'attribute' => 'event_id',
		'value' => function($data) {
		    return Yii::t('translation', $data->event->name_i18n);
		},
	    ],
		[
		'attribute' => 'risk_id',
		'value' => function($data) {
		    return Yii::t('translation', $data->risk->name_i18n);
		},
	    ],
	],
    ])
    ?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'event_risk_instruction_id')->hiddenInput()->label('') ?>

    <div class="row">
	<div class="col-lg-6">
	    <?=
	    $form->field($model, 'description_i18n')->widget('\common\components\widgets\inputmodal_i18n\InputModalI18n', [
		'button_modal_label' => \Yii::t('translation', 'translation'),
		'fieldType' => 'textarea',
		'options' => [
		    'rows' => 6
		]
	    ]);
	    ?>
	</div><!-- /.col-lg-6 -->

	<div class="col-lg-4">
	    <?=
	    $form->field($model, 'order')->textInput([
		'type' => 'number'
	    ])
	    ?>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-2">
	    <?= $form->field($model, 'status')->dropDownList(webapp\modules\risk\models\EventRiskInstructionItem::getStatusCombo()); ?>
	</div><!-- /.col-lg-2 -->

    </div>


    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/risk/event-risk-instruction/view', 'id' => $model->event_risk_instruction_id], ['class' => 'btn btn-primary']) ?>
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
