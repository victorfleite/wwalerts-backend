<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo Form::widget([// 1 column layout
	'model' => $model,
	'form' => $form,
	'columns' => 3,
	'attributes' => [
	    'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'state.name')]],
	    'state_id' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => ArrayHelper::map(\webapp\modules\local\models\State::find()->select(['gid', 'name'])->orderBy('name')->all(), 'gid', 'name'),
		'options' => [
		    'prompt' => ''
		]],
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
	    'latitude' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'city.latitude')]],
	    'longitude' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'city.longitude')]],
	    'the_geom_s' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'city.the_geom_s')]],
	    'geocode' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'city.geocode')]],
	]
    ]);
    ?>

    <?php /* $form->field($model, 'batch_id')->dropDownList(yii\helpers\ArrayHelper::map(webapp\modules\local\models\Batch::find()->orderBy('create_at desc'), 'id', 'created_at'), ['prompt' => '']); */ ?>

    <?=
	    $form->field($model, 'geom')
	    ->label(\Yii::t('translation', 'city.geom') . ' (' . \Yii::t('translation', 'city.geom_hint') . ')')
	    ->textArea(['rows' => '6', 'id' => 'wkt'])
    ?>

    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/local/city/index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
