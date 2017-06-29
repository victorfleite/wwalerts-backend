<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model webapp\models\Language */

$this->title = $language->code . ' ( ' . $language->getTranslationPercentage() . '% )';
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-create">

    <h1><?= $this->title ?></h1>

    <?php echo $this->render('_create-source-message', ['language' => $language, 'model' => new webapp\models\SourceMessage()]); ?>     

    <hr>
    <br>
    <h2><?= Yii::t('translation', 'language.keys_available_title') ?></h2>

    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($language, 'code')->label('')->hiddenInput(); ?>
    <?php
    foreach ($language->sourceMessages as $sourceMessage) {
	$link = Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-source-message', 'id' => $sourceMessage->id, 'code'=>$language->code], [
	    'class' => 'btn btn-danger',
	    'data' => [
		'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
		'method' => 'post',
	    ],
	]).'  '.Html::tag("strong", $sourceMessage->message); 
	echo $form->field($language, 'translations[' . $sourceMessage->id . ']')->label($link)->textInput();
    }
    ?>
    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['index'], ['class' => 'btn btn-primary']) ?>	
	<?= Html::submitButton(Yii::t('translation', 'language.save_messages_btn'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>    

</div>