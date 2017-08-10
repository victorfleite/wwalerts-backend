<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use webapp\modules\risk\models\Event;
use webapp\modules\risk\models\Risk;
use webapp\modules\alert\models\AlertStatus;
use webapp\modules\communication\models\Behavior;
use webapp\modules\communication\models\Trigger;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Trigger */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="behavior-form">

    <div class="alert alert-info">
	<p><strong><i class='fa fa-book'></i> <?php echo \Yii::t('translation', 'trigger.documentation'); ?></strong></p>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
	<div class="col-lg-4">
	    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-3">
	    <?=
	    $form->field($model, 'behavior_id')->dropDownList(
		    ArrayHelper::map(Behavior::find()->select(['id', 'name'])->orderBy('name')->all(), 'id', 'name')
		    , ['prompt' => '']);
	    ?>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-3">
	    <?=
	    $form->field($model, 'type')->dropDownList(
		    Trigger::getComboType()
		    , ['prompt' => '']);
	    ?>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-2">
	    <?= $form->field($model, 'status')->dropDownList(webapp\modules\communication\models\Trigger::getStatusCombo()); ?>
	</div><!-- /.col-lg-2 -->
    </div>
    <div class="row">
	<div class="col-lg-4">
	    <?=
	    $form->field($model, 'event_id')->dropDownList(
		    Event::getTranslatedComboArray('id', 'name_i18n')
		    , ['prompt' => \Yii::t('translation', 'trigger.all_events')]);
	    ?>
	</div><!-- /.col-lg-4 -->

	<div class="col-lg-4">
	    <?=
	    $form->field($model, 'risk_id')->dropDownList(
		    Risk::getTranslatedComboArray('id', 'name_i18n')
		    , ['prompt' => \Yii::t('translation', 'trigger.all_risks')]);
	    ?>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-4">
	    <?=
	    $form->field($model, 'alert_status_id')->dropDownList(
		    AlertStatus::getTranslatedComboArray('id', 'name_i18n', ['status' => AlertStatus::STATUS_ACTIVE]), [
		'prompt' => \Yii::t('translation', 'trigger.all_alerts_status')
	    ]);
	    ?>
	</div><!-- /.col-lg-4 -->	

    </div><!-- /.row -->
    <div class="row">
	<div class="col-lg-12">
	    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>
	</div><!-- /.col-lg-2 -->
    </div><!-- /.row -->

    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
