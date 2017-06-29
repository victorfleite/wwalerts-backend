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
    $items = ($model->isNewRecord)?(new Language())->getComboAvailableLanguages():yii\helpers\ArrayHelper::map(Language::find()->orderBy('code')->all(), 'code', 'code');
    //\Yii::$app->dumper->debug($items, true);
    echo Form::widget([// 1 column layout
	'model' => $model,
	'form' => $form,
	'columns' => 2,
	'attributes' => [
	    'code' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => $items,
		'options' => [
		    'prompt' => '',
		    'visible' => ((!$model->isNewRecord) ? true : false)
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
