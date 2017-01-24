<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use app\models\Professor;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>   
   
    
    <?php
        
       if($model->isNewRecord){
           ?>
           
            <?= $form->field($model, 'password_tmp')->passwordInput() ?>
    
    
           <?php
       }
    
    
    ?>
    
    <?= $form->field($model, 'status')->dropDownList(array(User::STATUS_ACTIVE =>User::STATUS_ACTIVE_LABEL, User::STATUS_DELETED=>User::STATUS_DELETED_LABEL),['prompt'=>'']); ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Novo' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
