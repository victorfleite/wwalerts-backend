<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Jogo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jogo-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    <?= $form->errorSummary($model); ?>
    
    <?php
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[
            'nome'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nome do Jogo']],
            'jogo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nome da App']],
        ]
    ]);?>
   <?= $form->field($model, 'descricao')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($model, 'habilidades')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    
    <?= $form->field($model, 'regulamento')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
