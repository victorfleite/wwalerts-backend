<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model app\models\Institution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="institution-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model) ?>

    <?php
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>3,
        'attributes'=>[
            'abbreviation'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>\Yii::t('translation', 'institution.abbreviation')]],
            'name'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>\Yii::t('translation', 'institution.name')]],
	    'country'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>\Yii::t('translation', 'institution.country')]]
        ]
    ]);?>
    <?php
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[
            'email'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>\Yii::t('translation', 'institution.email')]],
            'phone'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>\Yii::t('translation', 'institution.phone')]],
        ]
    ]);?>
    
    <h2><?= \Yii::t('translation', 'institution.cap_configuration_title') ?></h2>
    
    <?php
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'attributes'=>[
            'abbreviation_cap'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>\Yii::t('translation', 'institution.abbreviation_cap')]],
            'sender_cap'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>\Yii::t('translation', 'institution.sender_cap')]],
	    'contact_cap'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>\Yii::t('translation', 'institution.contact_cap')]],
	    'language_cap'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>\Yii::t('translation', 'institution.language_cap')]]
        ]
    ]);?>
   

    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/operative/institution/index'], ['class' => 'btn btn-primary']) ?>	
        <?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
