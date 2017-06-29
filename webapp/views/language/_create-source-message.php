<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="city-search">

    <?php
    $form = ActiveForm::begin([
		'action' => ['save-source-message'],
		'method' => 'post',
    ]);
    ?>
    <?= Html::hiddenInput('code', $language->code); ?>

    <?= $form->field($model, 'message')->label(Yii::t('translation', 'language.source_message_key_label'))->textInput(['maxlength' => true]) ?>

    <div class="text-right">
	<div class="form-group">
	    <?= Html::submitButton(Yii::t('translation', 'language.save_source_message_btn'), ['name' => 'btn-save-source-message', 'id' => 'btn-save-source-message', 'class' => 'btn btn-primary']) ?>
	</div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
