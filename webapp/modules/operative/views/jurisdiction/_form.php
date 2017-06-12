<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use backend\models\Institution;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use yii\web\JsExpression;
use \common\models\Config;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Jurisdiction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurisdiction-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
    echo Form::widget([// 1 column layout
	'model' => $model,
	'form' => $form,
	'columns' => 4,
	'attributes' => [
	    'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'jurisdiction.name')]],
	    'institution_id' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => ArrayHelper::map(Institution::find()->all(), 'id', 'name'),
		'options' => [
		]],
	    'color' => [
		'type' => Form::INPUT_WIDGET,
		'widgetClass' => '\kartik\widgets\ColorInput',
	    ],
	    'opacity' => [
		'type' => Form::INPUT_WIDGET,
		'widgetClass' => 'kartik\slider\Slider',
		'options' => [
		    'pluginOptions' => [
			'orientation' => 'horizontal',
			'handle' => 'round',
			'min' => 0,
			'max' => 1,
			'step' => 0.1
		    ],
		]
	    ]
	]
    ]);
    ?>
    <hr>
    <p class='text-right'>
	<?php
	Modal::begin([
	    'options' => [
		'id' => 'local-modal',
		'tabindex' => false, // important for Select2 to work properly
		'class' => 'modal fade bs-example-modal-lg'
	    ],
	    'header' => '<h4 style="margin:0; padding:0">' . \Yii::t('translation', 'jurisdiction.modal_locals_title') . '</h4>',
	    'toggleButton' => ['label' => \Yii::t('translation', 'jurisdiction.modal_locals_btn'), 'class' => 'btn btn-primary'],
	    'size' => Modal::SIZE_LARGE,
	]);

	echo "<label class='control-label'>" . \Yii::t('translation', 'countries') . "</label>";

	// The controller action that will render the list
	$url = \yii\helpers\Url::to(['/country/country-list']);
	echo Select2::widget([
	    'name' => 'state',
	    'options' => ['placeholder' => \Yii::t('translation', 'country.search_for'), 'multiple' => true],
	    'pluginOptions' => [
		'allowClear' => true,
		'minimumInputLength' => 3,
		'language' => [
		    'errorLoading' => new JsExpression("function () { return '" . \Yii::t('translation', 'waiting_for_results') . "'; }"),
		],
		'ajax' => [
		    'url' => $url,
		    'dataType' => 'json',
		    'data' => new JsExpression('function(params) { return {q:params.term}; }')
		],
		'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
		'templateResult' => new JsExpression('function(result) { return result.text; }'),
		'templateSelection' => new JsExpression('function (result) { return result.text; }'),
	    ],
	]);

	echo "<label class='control-label'>" . \Yii::t('translation', 'states') . "</label>";

	// The controller action that will render the list
	$url = \yii\helpers\Url::to(['/state/state-list']);
	echo Select2::widget([
	    'name' => 'state',
	    'options' => ['placeholder' => \Yii::t('translation', 'state.search_for'), 'multiple' => true],
	    'pluginOptions' => [
		'allowClear' => true,
		'minimumInputLength' => 3,
		'language' => [
		    'errorLoading' => new JsExpression("function () { return '" . \Yii::t('translation', 'waiting_for_results') . "'; }"),
		],
		'ajax' => [
		    'url' => $url,
		    'dataType' => 'json',
		    'data' => new JsExpression('function(params) { return {q:params.term}; }')
		],
		'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
		'templateResult' => new JsExpression('function(result) { return result.text; }'),
		'templateSelection' => new JsExpression('function (result) { return result.text; }'),
	    ],
	]);

	echo "<label class='control-label'>" . \Yii::t('translation', 'regions') . "</label>";

	// The controller action that will render the list
	$url = \yii\helpers\Url::to(['/region/region-list']);
	echo Select2::widget([
	    'name' => 'state',
	    'options' => ['placeholder' => \Yii::t('translation', 'region.search_for'), 'multiple' => true],
	    'pluginOptions' => [
		'allowClear' => true,
		'minimumInputLength' => 3,
		'language' => [
		    'errorLoading' => new JsExpression("function () { return '" . \Yii::t('translation', 'waiting_for_results') . "'; }"),
		],
		'ajax' => [
		    'url' => $url,
		    'dataType' => 'json',
		    'data' => new JsExpression('function(params) { return {q:params.term}; }')
		],
		'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
		'templateResult' => new JsExpression('function(result) { return result.text; }'),
		'templateSelection' => new JsExpression('function (result) { return result.text; }'),
	    ],
	]);

	echo "<label class='control-label'>" . \Yii::t('translation', 'cities') . "</label>";

	// The controller action that will render the list
	$url = \yii\helpers\Url::to(['/city/city-list']);
	echo Select2::widget([
	    'name' => 'state',
	    'options' => ['placeholder' => \Yii::t('translation', 'city.search_for'), 'multiple' => true],
	    'pluginOptions' => [
		'allowClear' => true,
		'minimumInputLength' => 3,
		'language' => [
		    'errorLoading' => new JsExpression("function () { return '" . \Yii::t('translation', 'waiting_for_results') . "'; }"),
		],
		'ajax' => [
		    'url' => $url,
		    'dataType' => 'json',
		    'data' => new JsExpression('function(params) { return {q:params.term}; }')
		],
		'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
		'templateResult' => new JsExpression('function(result) { return result.text; }'),
		'templateSelection' => new JsExpression('function (result) { return result.text; }'),
	    ],
	]);

	



	Modal::end();
	?>
    </p>


    <?=
	    $form->field($model, 'geom')
	    ->label(\Yii::t('translation', 'jurisdiction.geom') . ' (' . \Yii::t('translation', 'jurisdiction.geom_hint') . ')')
	    ->textArea(['rows' => '6', 'id' => 'wkt'])
    ?>


    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/jurisdiction/index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	<?= Html::button(Yii::t('translation', 'Preview'), ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    $generalVars = \Yii::$app->config->getVars();
    $latitude = $generalVars[Config::VARNAME_MAP_DEFAULT_CENTER_LATITUDE];
    $longitude = $generalVars[Config::VARNAME_MAP_DEFAULT_CENTER_LONGITUDE];
    $zoom = $generalVars[Config::VARNAME_MAP_DEFULT_ZOOM];

    $layers = [];
    $layers[] = new OL('layer.Tile', [
	'source' => new OL('source.OSM', [
	    'layer' => 'sat',
		]),
    ]);

    $feature = new JsExpression("readWktFeature('{$model->geom}')");
    $myStyle = new JsExpression("createStyle(hexToRGBA('{$model->color}',{$model->opacity}), 'rgba(0, 0, 0, 0.5)', 0.5)");

    $layers[] = new OL('layer.Vector', [
	'source' => new OL('source.Vector', [
	    'features' => [$feature]
		]
	),
	'style' => $myStyle
    ]);
//\Yii::$app->dumper->debug($layers, true);

    echo OpenLayers::widget([
	'id' => 'map',
	'mapOptionScript' => '@web/js/map.js',
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
    ?>

</div>
