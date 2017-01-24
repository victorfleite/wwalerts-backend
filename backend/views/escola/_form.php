<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Escola */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="escola-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    <?php
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[
            'nome'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nome da Escola']],
            'cnpj'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'CNPJ']],
        ]
    ]);?>
    
    <?php
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>3,
        'attributes'=>[
            'endereco'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Endereço da Escola']],           
            'cidade'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Cidade']],
            'uf'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'UF']],
        ]
    ]);?>
    <?php
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'attributes'=>[
            'ddd1'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'DD']],
            'telefone1'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Telefone']],
            'ddd2'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'DD']],
            'telefone2'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Fax']],
        ]
    ]);?>
    <?php
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>3,
        'attributes'=>[
            'nome_responsavel'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nome do Responsável']],           
            'site'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'http://www.sitedaescola.com.br']],
            'email'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'email@exemplo.com.br']],
        ]
    ]);?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Alterar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
