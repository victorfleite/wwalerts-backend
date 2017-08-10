<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use yii\web\JsExpression;
use \common\models\Config;

/* @var $this yii\web\View */
/* @var $model app\models\City */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.local_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
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
		[
		'attribute' => 'state_id',
		'value' => function($data) {
		    $state = \webapp\modules\local\models\State::findOne($data->state_id);
		    return $state->name;
		},
	    ],
		[
		'attribute' => 'country_id',
		'value' => function($data) {
		    $country = \webapp\modules\local\models\Country::findOne($data->country_id);
		    return $country->name;
		},
	    ],
	    'latitude',
	    'longitude',
	    'the_geom_s',
	    'geocode',
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
    $latitude = $generalVars[Config::VARNAME_MAP_DEFAULT_CENTER_LATITUDE];
    $longitude = $generalVars[Config::VARNAME_MAP_DEFAULT_CENTER_LONGITUDE];
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
