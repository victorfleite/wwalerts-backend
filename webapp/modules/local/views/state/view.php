<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use yii\web\JsExpression;
use \common\models\Config;

/* @var $this yii\web\View */
/* @var $model app\models\State */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.local_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'states'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-view">

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
	    'abbreviati',
	    'name',
	    array(
		'label' => Yii::t('translation', 'state.icon'),
		'format' => 'raw',
		'value' => function($data) {
		    return Html::a( Html::img($data->iconPathUrl), $data->iconPathUrl, $options = ['target'=>'_blank'] );
		},
	    ),
	    array(
		'label' => Yii::t('translation', 'state.icon_path'),
		'format' => 'raw',
		'value' => function($data) {
		    return Html::a( $data->icon_path, $data->iconPathUrl, $options = ['target'=>'_blank'] );
		},
	    ),
		[
		'attribute' => 'country_id',
		'value' => function($data) {
		    $country = \webapp\modules\local\models\Country::findOne($data->country_id);
		    return $country->name;
		},
	    ],
	    'center_lat',
	    'center_lon',
	    'cd_geocodu',
		[
		'attribute' => 'geom',
		'value' => function($data) {
		    return \common\models\Util::removeMiddleOfString($data->geom, 120);
		},
	    ]
	],
    ])
    ?>

    <?php
    $generalVars = \Yii::$app->config->getVars();

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
	],
    ]);
    // Centralizing map from feature
    $script = new JsExpression("setMapCenterFromFeature(sibilino.olwidget.getMapById('map'));");
    $this->registerJs($script);
    ?>


</div>
