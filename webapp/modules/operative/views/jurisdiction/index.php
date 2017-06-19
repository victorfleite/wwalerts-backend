<?php

use yii\helpers\Html;
use yii\grid\GridView;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use yii\web\JsExpression;
use \common\models\Config;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'jurisdictions');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.operative_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurisdiction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class='text-right'>
	<?= Html::a(Yii::t('translation', 'jurisdiction.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		[
		'attribute' => 'institution_id',
		'value' => 'institution.name',
	    ],
	    'name',
		[
		'attribute' => 'color',
		'format' => 'raw',
		'value' => function($data) {
		    return "<div style='background-color:" . \common\models\Util::convertColorHexToRGB($data->color, $data->opacity) . "'>&nbsp;</div>";
		},
	    ],
	    'created_at:datetime',
	    // 'updated_at',
	    // 'created_by',
	    // 'updated_by',
	    ['class' => 'yii\grid\ActionColumn'],
	],
    ]);
    ?>
</div>

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

foreach ($dataProvider->getModels() as $jurisdiction) {
    $feature = new JsExpression("readWktFeature('{$jurisdiction->geom}')");
    $myStyle = new JsExpression("createStyle(hexToRGBA('{$jurisdiction->color}',{$jurisdiction->opacity}), 'rgba(0, 0, 0, 0.5)', 0.5)");

    $layers[] = new OL('layer.Vector', [
	'source' => new OL('source.Vector', [
	    'features' => [$feature]
		]
	),
	'style' => $myStyle
    ]);
}
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
$script = new JsExpression("setMapCenterFromFeatures(sibilino.olwidget.getMapById('map'));");
$this->registerJs($script);
?>

