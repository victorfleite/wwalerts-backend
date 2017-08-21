<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use webapp\modules\alert\models\AlertStatus;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use yii\web\JsExpression;
use \common\models\Config;

$generalVars = \Yii::$app->config->getVars();
$latitude = $generalVars[Config::VARNAME_MAP_DEFAULT_CENTER_LATITUDE];
$longitude = $generalVars[Config::VARNAME_MAP_DEFAULT_CENTER_LONGITUDE];
$zoom = $generalVars[Config::VARNAME_MAP_DEFULT_ZOOM];
$zoom = $generalVars[Config::VARNAME_MAP_DEFULT_ZOOM];

/* @var $this yii\web\View */
/* @var $model webapp\modules\alert\models\Alert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alert-form">

    <?php
    $form = ActiveForm::begin([
		'fieldConfig' => ['template' => "{label}\n{input}\n{hint}"],
    ]);
    ?>
    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'geom')->hiddenInput(['id' => 'wkt'])->label(false) ?>
    <?= $form->field($model, 'map_base64')->hiddenInput(['id' => 'map_base64'])->label(false) ?>

    <div class="row">		    	    
	<div class="col-lg-2">
	    <?php
	    $events = webapp\modules\risk\models\Event::getTranslatedComboArray('id', 'name_i18n', [], ['order' => SORT_ASC]);
	    echo $form->field($model, 'event_id')->dropDownList($events, ['prompt' => \Yii::t('translation', 'alert.select_an_event')]);
	    ?>
	</div><!-- /.col-lg-3 -->

	<div class="col-lg-2">
	    <?php
	    $risks = webapp\modules\risk\models\Risk::getTranslatedComboArray('id', 'name_i18n', [], ['order' => SORT_ASC]);
	    echo $form->field($model, 'risk_id')->dropDownList($risks, ['prompt' => \Yii::t('translation', 'alert.select_a_risk')]);
	    ?>
	</div><!-- /.col-lg-3 -->
	<div class="col-lg-2">
	    <div class="form-group">
		<label class="control-label"><?php echo $model->getAttributeLabel('start'); ?></label>
		<?=
		DateTimePicker::widget([
		    'model' => $model,
		    'attribute' => 'start',
		    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
		    'options' => ['readOnly' => true],
		    'pluginOptions' => [
			'autoclose' => true,
			'format' => 'dd/mm/yyyy hh:ii',
			'todayHighlight' => true,
			'todayBtn' => true,
			'minuteStep' => 1
		    ]
		]);
		?>
	    </div>
	</div><!-- /.col-lg-2 -->
	<div class="col-lg-2">
	    <div class="form-group">
		<label class="control-label"><?php echo $model->getAttributeLabel('end'); ?></label>
		<?=
		DateTimePicker::widget([
		    'model' => $model,
		    'attribute' => 'end',
		    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
		    'options' => ['readOnly' => true],
		    'pluginOptions' => [
			'autoclose' => true,
			'format' => 'dd/mm/yyyy hh:ii',
			'todayHighlight' => true,
			'todayBtn' => true,
			'minuteStep' => 1
		    ]
		]);
		?>
	    </div>
	</div><!-- /.col-lg-2 -->
	<div class="col-lg-2">
	    <?php
	    $alertStatus = AlertStatus::getTranslatedComboArray('id', 'name_i18n', ['status' => AlertStatus::STATUS_ACTIVE], ['order' => SORT_ASC]);
	    echo $form->field($model, 'alert_status_id')->dropDownList($alertStatus, [
		'prompt' => \Yii::t('translation', 'alert.select_an_alert_status')
	    ]);
	    ?>
	</div><!-- /.col-lg-1 -->

	<div class="col-lg-1">
	    <div class="form-group">
		<label class="control-label"></label>
		<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => 'form-control btn btn-success']) ?>
	    </div>
	</div><!-- /.col-lg-1 -->
	<div class="col-lg-1">
	    <div class="form-group">
		<label class="control-label"></label>
		<?= Html::a(Yii::t('translation', 'Cancel'), ['/alert/alert/index'], ['class' => 'form-control btn btn-primary']) ?>
	    </div>
	</div><!-- /.col-lg-1 -->
    </div>
    <div class="row">
	<div class="col-lg-12">
	    <?=
		    $form->field($model, 'description')
		    ->label(\Yii::t('translation', 'alert.description'))
		    ->textArea(['rows' => '2', 'id' => 'description', 'disabled' => true])
	    ?>
	</div><!-- /.col-lg-1 -->
    </div>
    <div class="row">
	<div class="col-lg-1">

	    <ul class="nav nav-pills nav-stacked">
		<li><a href="#">Tool1</a></li>
		<li><a href="#">Tool2</a></li>
		<li><a href="#">Tool3</a></li>
	    </ul>


	</div><!-- /.col-lg-1 -->
	<div class="col-lg-11">
	    <div class='map'>

		<?php
		$raster = new OL('layer.Tile', [
		    'source' => new OL('source.OSM', [
			'layer' => 'sat',
			    ]),
		]);

		/*
		  $feature = new JsExpression("readWktFeature('{$model->geom}', 'EPSG:3857', 'EPSG:3857')");
		  $myStyle = new JsExpression("createStyle(hexToRGBA('#38721d',1), 'rgba(0, 0, 0, 0.5)', 0.5)");

		  $vector = new OL('layer.Vector', [
		  'source' => new OL('source.Vector', [
		  'features' => [$feature]
		  ]
		  ),
		  'style' => $myStyle
		  ]);
		 * 
		 */
		//\Yii::$app->dumper->debug($layers, true);

		echo OpenLayers::widget([
		    'id' => 'map',
		    'mapOptionScript' => '@web/js/map-commons.js',
		    'mapOptions' => [
			'layers' => [$raster],
			// Using a shortcut, we can skip the OL('View' ...)
			'view' => [
			    // Of course, the generated JS can be customized with JsExpression, as usual
			    'center' => new JsExpression('ol.proj.transform([' . $longitude . ', ' . $latitude . '], "EPSG:4326", "EPSG:3857")'),
			    'zoom' => $zoom,
			],
		    ],
		]);
		// Centralizing map from feature
		$script = new JsExpression("setMapCenterFromFeature(sibilino.olwidget.getMapById('map'));");
		$this->registerJs($script);
		?>

	    </div>
	</div><!-- /.col-lg-12 -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
