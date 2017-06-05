<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use \backend\models\Jurisdiction;

/* @var $this yii\web\View */
/* @var $model backend\models\Workgroup */

$this->params ['breadcrumbs'] [] = [
    'label' => Yii::t('app', 'workgroups'),
    'url' => [
	'index'
    ]
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="grupo-view">

    <h1>Associete Jurisdictions</h1>
    <?= DetailView::widget(['model' => $workgroup, 'attributes' => ['name', 'description']]);
    $form = ActiveForm::begin(); ?>
    <div>

	<?php
	echo maksyutin\duallistbox\Widget::widget([
	    'model' => $model,
	    'attribute' => 'jurisdictions',
	    'title' => 'Associate Jurisdictions',
	    'data' => Jurisdiction::find(),
	    'data_id' => 'id',
	    'data_value' => 'name',
	    'lngOptions' => [
		'search_placeholder' => 'Search',
		'showing' => ' - Jurisdictions',
		'available' => 'Não contidas',
		'selected' => 'Contidas'
	    ]
	]);
	?> 

    </div>
    <p>&nbsp;</p>
    <div class="form-group">
	<?= Html::submitButton("Salvar", ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <h3>Geometrias das Jurisdições contidas no Grupo</h3>
    <div id="map" style="height: 440px"></div>
    <script type="text/javascript">
	$(document).ready(function () {




	    var vertexStyle = {
		strokeColor: "#FF0000",
		fillColor: "#FF0000",
		strokeOpacity: 1,
		strokeWidth: 2,
		pointRadius: 6,
		graphicName: "circle"
	    };

	    var virtual = {
		strokeColor: "#EE9900",
		fillColor: "#EE9900",
		strokeOpacity: 1,
		strokeWidth: 2,
		pointRadius: 4,
		graphicName: "circle"
	    };


	    var fromProjection = new OpenLayers.Projection("EPSG:4326");
	    var toProjection = new OpenLayers.Projection("EPSG:900913");

	    var worldAlertas = new OpenLayers.Bounds(-73.839434, -33.770856, -34.858104, 5.38289).transform(fromProjection, toProjection);

	    var toolbar;
	    var panel_controls;
	    var controle_vector = true;


	    var map = new OpenLayers.Map({
		div: "map",
		projection: toProjection,
		displayProjection: fromProjection,
		layers: [new OpenLayers.Layer.OSM("OSM", "", {displayInLayerSwitcher: false})]
	    });

	    layer_vector = new OpenLayers.Layer.Vector({
		layers: "Poligonos"
	    }, {
		displayInLayerSwitcher: false
	    });
	    layer_vector.displayInLayerSwitcher = false;


	    map.addLayer(layer_vector);
	    map.setCenter(new OpenLayers.LonLat(-54.404297, -14.774883).transform(fromProjection, toProjection), 4);


<?php foreach ($grupo->jurisdicaos as $jurisdicao) { ?>
    <?php $cor = (($jurisdicao->cor) ? $jurisdicao->cor : '#00ff00'); ?>
    	    var style = new OpenLayers.Style({fillColor: '<?php echo $cor ?>', 'strokeWidth': 1, 'strokeColor': '#000', fillOpacity: 0.6});
    	    var layer_vector_polygon = new OpenLayers.Layer.Vector("Vector Criando", {styleMap: style});
    	    layer_vector_polygon.displayInLayerSwitcher = false;
    	    var wkt = new OpenLayers.Format.WKT();
    	    var features = wkt.read("<?php echo $jurisdicao->geometria ?>");
    	    if (features) {
    		layer_vector_polygon.addFeatures(features);
    		map.addLayer(layer_vector_polygon);
    	    } else {
    		console.log('Bad WKT');
    	    }

<?php } ?>



	});
    </script>



</div>
