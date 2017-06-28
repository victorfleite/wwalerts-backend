<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use webapp\models\Language;

/* @var $this yii\web\View */
/* @var $model webapp\models\Language */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="language-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    echo Form::widget([// 1 column layout
	'model' => $model,
	'form' => $form,
	'columns' => 2,
	'attributes' => [
	    'code' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => (new Language())->getComboLanguages(),
		'options' => [
		    'prompt' => ''
		]],
	    'status' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => Language::getStatusCombo(),
		'options' => [
		    'prompt' => ''
		]],
	   
	]
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
