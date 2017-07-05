<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model webapp\models\Language */
/* @var $form yii\widgets\ActiveForm */
?>

<div>

    <?php $form = ActiveForm::begin(['options'=>[]]); ?>
    <?php echo Html::hiddenInput('id', $sourceMessage->id) ?>

    <?php foreach ($inputs as $languageCode=>$value) { ?>
        <div class="form-group">
	    <label><?= \Yii::t('translation', 'language.'.$languageCode)?></label>
	    <?= Html::input('text', 'translation['.$languageCode.']', $value, ['class'=>"form-control"]) ?>
        </div>
    <?php } ?>
    <div class="form-group">
	<?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
