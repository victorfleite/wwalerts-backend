<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use yii\web\JsExpression;
use \common\models\Config;

/* @var $this yii\web\View */
/* @var $model app\models\Country */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->gid], ['class' => 'btn btn-primary']) ?>
	<?=
	Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->gid], [
	    'class' => 'btn btn-danger',
	    'data' => [
		'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
		'method' => 'post',
	    ],
	])
	?>
    </p>

    <?=
    DetailView::widget([
	'model' => $model,
	'attributes' => [
	    'name',
	    'un',
	    'fips',
	    'iso2',
	    'iso3',
	    'name',
	    'area',
	    'pop2005',
	    'region',
	    'subregion',
	    'lon',
	    'lat',
		[
		'attribute' => 'geom',
		'value' => function($data) {
		    return \common\models\Util::removeMiddleOfString($data->geom, 120);
		},
	    ],
	],
    ])
    ?>

    <?php
    $generalVars = \Yii::$app->config->getVars();
    $latitude = floatval($model->lat);
    $longitude = floatval($model->lon);
    $zoom = $generalVars[Config::VARNAME_MAP_DEFULT_ZOOM];

    $raster = new OL('layer.Tile', [
	'source' => new OL('source.OSM', [
	    'layer' => 'sat',
		]),
    ]);

    $feature = new JsExpression("readWktFeature('{$model->geom}', 'EPSG:3857', 'EPSG:3857')");
    $myStyle = new JsExpression("createStyle(hexToRGBA('#38721d',1), 'rgba(0, 0, 0, 0.5)', 0.5)");

    $vector = new OL('layer.Vector', [
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
	    'layers' => [$raster, $vector],
	    // Using a shortcut, we can skip the OL('View' ...)
	    /*'view' => [
		// Of course, the generated JS can be customized with JsExpression, as usual
		'center' => new JsExpression('ol.proj.transform([' . $longitude . ', ' . $latitude . '], "EPSG:4326", "EPSG:3857")'),
		'zoom' => $zoom,
	    ],*/
	],
    ]);
    $script = new JsExpression(
	      "var map = sibilino.olwidget.getMapById('map');"
	    . "var extent;"
	    . "var feature = map.getLayers().getArray()[1].getSource().getFeatures()[0];"
	    . "extent = feature.getGeometry().getExtent();"
	    . "map.getView().fit(extent,map.getSize());"
	    
	    );
    $this->registerJs($script);
    
    
    
    ?>

</div>
