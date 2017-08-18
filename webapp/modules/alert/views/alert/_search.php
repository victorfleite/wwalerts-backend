<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \yii\helpers\ArrayHelper;
use webapp\modules\alert\models\AlertStatus;
use kartik\date\DatePicker;
use webapp\modules\alert\models\AlertSearch;

/* @var $this yii\web\View */
/* @var $model webapp\modules\alert\models\AlertSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="city-search">

    <?php
    $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
    ]);
    ?>


    <div class="row">
	<div class='col-lg-4'>
	    <?= $form->field($model, 'situation')->radioList([webapp\modules\alert\models\AlertSearch::SITUATION_ALL => \Yii::t('translation', 'alert.search_situation_all'), webapp\modules\alert\models\AlertSearch::SITUATION_AVAILABLES => \Yii::t('translation', 'alert.search_situation_availables')], []); ?>
	</div>	    	    
	<div class="col-lg-4">
	    <?php
	    $events = webapp\modules\risk\models\Event::getTranslatedComboArray('id', 'name_i18n');
	    echo $form->field($model, 'event_id')->dropDownList($events, ['prompt' => \Yii::t('translation', 'alert.all_events')]);
	    ?>
	</div><!-- /.col-lg-4 -->

	<div class="col-lg-4">
	    <?php
	    $risks = webapp\modules\risk\models\Risk::getTranslatedComboArray('id', 'name_i18n');
	    echo $form->field($model, 'risk_id')->dropDownList($risks, ['prompt' => \Yii::t('translation', 'alert.all_risks')]);
	    ?>
	</div><!-- /.col-lg-4 -->

    </div>	
    <div class="row">
	<div class="col-lg-4">
	    <div class="form-group">
		<label class="control-label"><?php echo $model->getAttributeLabel('start'); ?></label>
		<?=
		DatePicker::widget([
		    'model' => $model,
		    'attribute' => 'start',
		    'type' => DatePicker::TYPE_COMPONENT_APPEND,
		    'options' => ['readOnly' => true],
		    'pluginOptions' => [
			'autoclose' => true,
			'format' => 'yyyy-mm-dd',
			'todayHighlight' => true,
			'todayBtn' => true,
		    //'minuteStep'=>1
		    ]
		]);
		?>
	    </div>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-4">
	    <label class="control-label"><?php echo $model->getAttributeLabel('end'); ?></label>
	    <div class="form-group">
		<?=
		DatePicker::widget([
		    'model' => $model,
		    'attribute' => 'end',
		    'type' => DatePicker::TYPE_COMPONENT_APPEND,
		    'options' => ['readOnly' => true],
		    'pluginOptions' => [
			'autoclose' => true,
			'format' => 'yyyy-mm-dd',
			'todayHighlight' => true,
			'todayBtn' => true,
		    //'minuteStep'=>1
		    ]
		]);
		?>
	    </div>
	</div><!-- /.col-lg-4 -->

	<div class="col-lg-4">
	    <?php
	    $alertStatus = AlertStatus::getTranslatedComboArray('id', 'name_i18n', ['status' => AlertStatus::STATUS_ACTIVE]);
	    echo $form->field($model, 'alert_status_id')->dropDownList($alertStatus, [
		'prompt' => \Yii::t('translation', 'alert.all_status')
	    ]);
	    ?>

	</div><!-- /.col-lg-4 -->

    </div>	


    <div class="form-group">
	<?= Html::submitButton(Yii::t('translation', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>