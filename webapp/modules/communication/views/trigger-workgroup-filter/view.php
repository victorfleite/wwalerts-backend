<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use yii\web\JsExpression;
use \common\models\Config;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\TriggerGroupFilter */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'workgroups'), 'url' => ['/operative/workgroup/index']];
$this->params['breadcrumbs'][] = ['label' => $workgroup->name, 'url' => ['/operative/workgroup/view', 'id' => $workgroup->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'triggerworkgroupfilter');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trigger-group-filter-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class='text-right'>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'trigger_id' => $model->trigger_id, 'workgroup_id' => $model->workgroup_id], ['class' => 'btn btn-primary']) ?>
	<?=
	Html::a(Yii::t('translation', 'Delete'), ['delete', 'trigger_id' => $model->trigger_id, 'workgroup_id' => $model->workgroup_id], [
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
		'attribute' => 'workgroup_id',
		'value' => function($data) {
		    return $data->workgroup->name;
		},
	    ],
		[
		'attribute' => 'trigger_id',
		'value' => function($data) {
		    return $data->trigger->name;
		},
	    ],
	    'description',
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\communication\models\TriggerWorkgroupFilter::getStatusLabel($data->status);
		},
	    ],
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

    $layers = [];
    $layers[] = new OL('layer.Tile', [
	'source' => new OL('source.OSM', [
	    'layer' => 'sat',
		]),
    ]);

    $feature = new JsExpression("readWktFeature('{$model->geom}', 'EPSG:3857', 'EPSG:3857')");
    $myStyle = new JsExpression("createStyle(hexToRGBA('#38721d',1), 'rgba(0, 0, 0, 0.5)', 0.5)");

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
    ?>

</div>
