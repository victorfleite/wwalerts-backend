<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use app\models\Institution;

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

</div>
