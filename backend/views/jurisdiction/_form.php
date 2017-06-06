<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use backend\models\Institution;
use sibilino\yii2\openlayers\OpenLayers;
use sibilino\yii2\openlayers\OL;
use yii\web\JsExpression;

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
	'columns' => 3,
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
	]
    ]);
    ?>
    <?= $form->field($model, 'geom')
	    ->label(\Yii::t('translation', 'jurisdiction.geom') . ' ('. \Yii::t('translation', 'jurisdiction.geom_hint').')')
	    ->textArea(['rows' => '6', 'id'=>'wkt']) ?>
   

    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    
    
    <?php
    echo OpenLayers::widget([
	'id' => 'test',
	'mapOptions' => [
	    'layers' => [
		// Easily generate JavaScript "new ol.layer.Tile()" using the OL class
		new OL('layer.Tile', [
		    'source' => new OL('source.OSM', [
			'layer' => 'sat',
			    ]),
			]),
	    ],
	    // Using a shortcut, we can skip the OL('View' ...)
	    'view' => [
		// Of course, the generated JS can be customized with JsExpression, as usual
		'center' => new JsExpression('ol.proj.transform([37.41, 8.82], "EPSG:4326", "EPSG:3857")'),
		'zoom' => 4,
	    ],
	],
    ]);
    ?>

</div>
