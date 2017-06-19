<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model app\models\Region */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    echo Form::widget([// 1 column layout
	'model' => $model,
	'form' => $form,
	'columns' => 3,
	'attributes' => [
	    'nm_meso' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'region.nm_meso')]],	  
	    'country_id' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => ArrayHelper::map(\webapp\modules\local\models\Country::find()->select(['gid', 'name'])->orderBy('name')->all(), 'gid', 'name'),
		'options' => [
		    'prompt' => ''
		]],
	    'cd_geocodu' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => \Yii::t('translation', 'region.cd_geocodu')]], 	
	]
    ]);
    ?>
    
    <?=
	    $form->field($model, 'geom')
	    ->label(\Yii::t('translation', 'region.geom') . ' (' . \Yii::t('translation', 'region.geom_hint') . ')')
	    ->textArea(['rows' => '6', 'id' => 'wkt'])
    ?>

    <div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
