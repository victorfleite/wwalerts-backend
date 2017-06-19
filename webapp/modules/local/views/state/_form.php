<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\State */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="state-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model) ?>
    
    <?php
    echo Form::widget([// 1 column layout
	'model' => $model,
	'form' => $form,
	'columns' => 3,
	'attributes' => [
	    'abbreviati' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'state.abbreviati')]],
	    'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'state.name')]],
	    'country_id' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => ArrayHelper::map(\webapp\modules\local\models\Country::find()->select(['gid', 'name'])->orderBy('name')->all(), 'gid', 'name'),
		'options' => [
		    'prompt' => ''
		]],	    
	]
    ]);
    ?>
    
    <?php
    echo Form::widget([// 1 column layout
	'model' => $model,
	'form' => $form,
	'columns' => 4,
	'attributes' => [
	    'center_lat' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'state.center_lat')]],
	    'center_lon' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'state.center_lon')]],
	    'icon_path' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'state.icon_path')]],
	    'cd_geocodu' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'state.cd_geocodu')]],
	    	    
	]
    ]);
    ?>

    <?=
	    $form->field($model, 'geom')
	    ->label(\Yii::t('translation', 'state.geom') . ' (' . \Yii::t('translation', 'state.geom_hint') . ')')
	    ->textArea(['rows' => '6', 'id' => 'wkt'])
    ?>


    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
