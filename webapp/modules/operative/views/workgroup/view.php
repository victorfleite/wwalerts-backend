<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\User;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use yii\web\JsExpression;
use \common\models\Config;

/* @var $this yii\web\View */
/* @var $model app\models\Workgroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.operative_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'workgroups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workgroup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class='text-right'>
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?=
	Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->id], [
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
	    'description',
	    'created_at:datetime',
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\operative\models\Workgroup::getStatusLabel($data->status);
		},
	    ],
	],
    ])
    ?>
    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'workgroup.communication_filter_btn'), ['/communication/trigger-workgroup-filter/create', 'workgroup_id' => $model->id], ['class' => 'btn btn-primary']) ?>	
    </p>

    <h3><?= Yii::t('translation', 'workgroup.communication_filter_title') ?></h3>
    <?php
    $filters = $model->getCommunicationFilters()->all();
    $dataProvider = new ArrayDataProvider([
	'allModels' => $filters,
	'sort' => [
	    'attributes' => ['name'],
	],
	'pagination' => [
	    'pageSize' => 10,
	],
    ]);

    echo GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		[
		'label' => \Yii::t('translation', 'triggerworkgroupfilter.name'),
		'value' => function($data) {
		    return $data->name;
		},
	    ], [
		'label' => \Yii::t('translation', 'triggerworkgroupfilter.trigger_id'),
		'value' => function($data) {
		    return $data->trigger->name;
		},
	    ],
		[
		'label' => \Yii::t('translation', 'triggerworkgroupfilter.status'),
		'value' => function($data) {
		    return webapp\modules\communication\models\TriggerWorkgroupFilter::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{view}{update}{delete}',
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['/communication/trigger-workgroup-filter/view', 'workgroup_id' => $model->workgroup_id, 'trigger_id' => $model->trigger_id]);
		    }
		    if ($action === 'update') {
			return Url::to(['/communication/trigger-workgroup-filter/update', 'workgroup_id' => $model->workgroup_id, 'trigger_id' => $model->trigger_id]);
		    }
		    if ($action === 'delete') {
			return Url::to(['/communication/trigger-workgroup-filter/delete', 'workgroup_id' => $model->workgroup_id, 'trigger_id' => $model->trigger_id]);
		    }
		}
	    ],
	],
    ]);
    ?>
    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'workgroup.associate_user_btn'), ['workgroup/associate-user', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <h3><?= Yii::t('translation', 'users') ?></h3>
    <?php
    $dataProvider = new ArrayDataProvider([
	'allModels' => $model->getUsers()->all(),
	'sort' => [
	    'attributes' => ['name'],
	],
	'pagination' => [
	    'pageSize' => 10,
	],
    ]);

    echo GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
	    'name',
	    'username',
	    'email:email',
	    'created_at:datetime',
		[
		'attribute' => 'status',
		'filter' => User::getStatusCombo(),
		'value' => function($data) {
		    return User::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{view}',
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['/user/view', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
    ?>
    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'workgroup.associate_jurisdiction_btn'), ['workgroup/associate-jurisdiction', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <h3><?= Yii::t('translation', 'jurisdictions') ?></h3>
    <?php
    $jurisdictions = $model->getJurisdictions()->all();
    $dataProvider = new ArrayDataProvider([
	'allModels' => $jurisdictions,
	'sort' => [
	    'attributes' => ['name'],
	],
	'pagination' => [
	    'pageSize' => 10,
	],
    ]);

    echo GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
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
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{view}',
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['jurisdiction/view', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
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

    foreach ($jurisdictions as $jurisdiction) {
	$feature = new JsExpression("readWktFeature('{$jurisdiction->geom}', 'EPSG:3857', 'EPSG:3857')");
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




</div>