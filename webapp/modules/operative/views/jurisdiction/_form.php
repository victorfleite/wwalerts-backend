<?php

use yii\helpers\Html;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use webapp\modules\operative\models\Institution;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use \common\models\Config;
use \common\components\widgets\modal_import_geometry\ModalImportGeometry;

/* @var $this yii\web\View */
/* @var $model app\models\Jurisdiction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurisdiction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

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
    <?=
	    $form->field($model, 'description')
	    ->label(\Yii::t('translation', 'jurisdiction.description'))
	    ->textArea(['rows' => '4']);
    ?>
    <hr>
    <p class="text-right">

	<?php echo ModalImportGeometry::widget(['id' => 'import-local', 'outputField' => 'wkt', 'toggleButton' => ['label' => 'Importar Locais', 'class' => 'btn btn-primary']]); ?>

    </p>

    <?=
	    $form->field($model, 'geom')
	    ->label(\Yii::t('translation', 'jurisdiction.geom') . ' (' . \Yii::t('translation', 'jurisdiction.geom_hint') . ')')
	    ->textArea(['rows' => '6', 'id' => 'wkt'])
    ?>


    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/operative/jurisdiction/index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	<?= Html::submitButton(Yii::t('translation', 'Preview'), ['name' => 'btn-preview', 'id'=>'btn-preview', 'class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>    


    <?php
    if ((!$model->hasErrors() && $model->isNewRecord && \Yii::$app->request->isPost) || (!$model->hasErrors() && !$model->isNewRecord)) {

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

	$feature = new JsExpression("readWktFeature('{$model->geom}', 'EPSG:3857', 'EPSG:3857')");
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

	// Centralizing map from feature
	$script = new JsExpression("setMapCenterFromFeature(sibilino.olwidget.getMapById('map'));");
	$this->registerJs($script);
    }
    ?>

</div>
