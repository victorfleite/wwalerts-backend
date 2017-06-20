<?php

use yii\web\JsExpression;
use yii\bootstrap\Modal;
use kartik\widgets\Select2;
use common\components\helpers\Writer;

// Scripts
$string = new Writer();
$string->writeln("$(function() {");
$string->writeln("	$('#" . $id . "').on('hidden.bs.modal', function () {");
$string->writeln("	  $('#msg-fields-empty').hide();");
$string->writeln("	});");
$string->writeln("  $('#btn-merge-geometries').click(function(){");
$string->writeln("	$('#msg-fields-empty').hide();");
$string->writeln("	var data = {country: $( '#country_search' ).val(), state: $( '#state_search' ).val(), region: $( '#region_search' ).val(), city: $( '#city_search' ).val(), }; console.log(data);");
$string->writeln("	if(data.country || data.state || data.region || data.city){");
$string->writeln("		$.ajax({");
$string->writeln("		    type: 'POST',");
$string->writeln("		    url: '" . \yii\helpers\Url::toRoute('/local/geometry/merge-locations') . "',");
$string->writeln("		    data: data,");
$string->writeln("		    success: function(r){");
$string->writeln("			$('#" . $outputField . "').val(r.wkt)");
$string->writeln("			$('#" . $id . "').modal('toggle');");
$string->writeln("		    },");
$string->writeln("		    dataType: 'json'");
$string->writeln("		});");
$string->writeln("	} else {");
$string->writeln("	    $('#msg-fields-empty').show();");
$string->writeln("	}");
$string->writeln("   });");
$string->writeln("});");

$script = new JsExpression($string->getString());
$this->registerJs($script);

Modal::begin([
    'id' => $id,
    'header' => '<h4 class="modal-title text-center">' . \Yii::t('translation', 'modal_import_locals_title') . '</h4>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">' . \Yii::t('translation', 'modal_import_locals_btn_close') . '</button>
                <button type="button" class="btn btn-primary" id="btn-merge-geometries">' . \Yii::t('translation', 'modal_import_locals_btn_create_geometry') . '</button>',
    'toggleButton' => $toggleButton,
    'options' => $options,
]);


echo "<div class='alert alert-danger' id='msg-fields-empty' style='display:none'>";
echo "  <strong>Danger!</strong> " . \Yii::t('translation', 'modal_import_locals_msg_fields_empty');
echo "</div>";

echo "<label class='control-label'>" . \Yii::t('translation', 'countries') . "</label>";

// The controller action that will render the list
$url = \yii\helpers\Url::to(['/local/country/country-list']);
echo Select2::widget([
    'name' => 'state',
    'options' => ['placeholder' => \Yii::t('translation', 'country.search_for'), 'multiple' => true, 'id' => 'country_search'],
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
$url = \yii\helpers\Url::to(['/local/state/state-list']);
echo Select2::widget([
    'name' => 'state',
    'options' => ['placeholder' => \Yii::t('translation', 'state.search_for'), 'multiple' => true, 'id' => 'state_search'],
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
$url = \yii\helpers\Url::to(['/local/region/region-list']);
echo Select2::widget([
    'name' => 'state',
    'options' => ['placeholder' => \Yii::t('translation', 'region.search_for'), 'multiple' => true, 'id' => 'region_search'],
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
$url = \yii\helpers\Url::to(['/local/city/city-list']);
echo Select2::widget([
    'name' => 'state',
    'options' => ['placeholder' => \Yii::t('translation', 'city.search_for'), 'multiple' => true, 'id' => 'city_search'],
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

