<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use common\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\Professor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="professor-form">

    <?php $form = ActiveForm::begin(); ?>

     <?php
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[
            'id'=>['type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                        'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                        'options' => ['placeholder' => 'Selecione o Usuário'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
            ]],
            'cpf'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'CPF']],
        ]
    ]);?>
    <?php
    
        echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[
            'biografia'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Entre com a biografia']],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Novo') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
