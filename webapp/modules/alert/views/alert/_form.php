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

$this->registerJsFile('@web/js/FileSaver.min.js', []);
?>

<div class="alert-form">

    <?php
    $form = ActiveForm::begin([
		'id' => 'alert-form',
		'fieldConfig' => ['template' => "{label}\n{input}\n{hint}"],
    ]);
    ?>
    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'geom')->textInput(['id' => 'wkt'])->label(false) ?>
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
			'format' => 'yyyy-mm-dd hh:ii',
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
			'format' => 'yyyy-mm-dd hh:ii',
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
		<?php
		echo Html::button($model->isNewRecord ? \Yii::t('translation', 'Create') : \Yii::t('translation', 'Update'), ['id' => 'submit-button', 'class' => $model->isNewRecord ? 'form-control btn btn-success' : 'form-control btn btn-primary']);

		$script = <<< JS
		    $(function(){
			$("#alert-form").on("afterValidate", function (event, messages) {
				
				var form = $(this);
				// return false if form still have some validation errors
				if (form.find('.has-error').length) {
				     return false;
				}else{
				    var mapObj = sibilino.olwidget.getMapById('map');
				     
				    setMapCenterFromFeature(mapObj);			
				    
				    var format = 'a4';
				    // Resolution could be 72 dpi (fast),150 dpi and 300 dpi (slow)
				    var resolution = '150';
				    var dims = {
					a0: [1189, 841],
					a1: [841, 594],
					a2: [594, 420],
					a3: [420, 297],
					a4: [297, 210],
					a5: [210, 148]
				    };
			
				    var dim = dims[format];
				    var width = Math.round(dim[0] * resolution / 25.4);
				    var height = Math.round(dim[1] * resolution / 25.4);
				    var size = (mapObj.getSize());
			
				    mapObj.setSize([width, height]);
			
				    mapObj.renderSync();
			
				    canvas = document.getElementsByTagName('canvas')[0];
				    var base64Str = canvas.toDataURL('image/png');
				    $('#map_base64').val(base64Str);
				}
			
			});
			
			
			$('#submit-button').click(function(event) {
			    $('#alert-form').submit();			
			});   
		    });		    
JS;
		$this->registerJs($script, \yii\web\View::POS_END);
		?>
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


		$user = \common\models\User::findOne(\Yii::$app->user->id);
		$jurisdictions = $user->getJurisdictionsPolygon();


		$layers = [];
		$layers[] = new OL('layer.Tile', [
		    'source' => new OL('source.OSM', [
			'layer' => 'sat',
			    ]),
		]);

		foreach ($jurisdictions as $jurisdiction) {
		    //Yii::$app->dumper->debug($jurisdiction, true);
		    $feature = new JsExpression("readWktFeature('{$jurisdiction['geometry']}', 'EPSG:3857', 'EPSG:3857')");
		    $myStyle = new JsExpression("createStyle(hexToRGBA('{$jurisdiction['color']}',{$jurisdiction['opacity']}), 'rgba(0, 0, 0, 0.5)', 0.5)");

		    $layers[] = new OL('layer.Vector', [
			'source' => new OL('source.Vector', [
			    'features' => [$feature]
				]
			),
			'style' => $myStyle
		    ]);
		}

		echo OpenLayers::widget([
		    'id' => 'map',
		    'mapOptionScript' => '@web/js/map-commons.js',
		    'mapOptions' => [
			'layers' => $layers,
			// Using a shortcut, we can skip the OL('View' ...)
			'view' => [
			    // Of course, the generated JS can be customized with JsExpression, as usual
			    'center' => new JsExpression('ol.proj.transform([' . $longitude . ', ' . $latitude . '], "EPSG:4326", "EPSG:3857")'),
			    'zoom' => $zoom,
			],
		    ],
		]);
		
		$this->registerJsFile('@web/js/map-alert-init.js', ['depends' => [sibilino\yii2\openlayers\OpenLayersBundle::className()]]);
		?>

	    </div>
	</div><!-- /.col-lg-12 -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
