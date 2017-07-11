<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model webapp\models\Language */

$this->title = $language->code . ' ( ' . $language->getTranslationPercentage() . '% )';
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<a id="up"></a>
<div class="language-create">

    <h1><?= $this->title ?></h1>

    <?php echo $this->render('_create-source-message', ['language' => $language, 'model' => new webapp\models\SourceMessage()]); ?>     

    <hr>
    <br>

    <div class="row">
	<div class="col-md-6">
	    <h2><?= Yii::t('translation', 'language.keys_available_title') ?></h2>
	</div><!-- /.col-lg-6 -->
	<div class="col-md-6">
	    <h2><?= Yii::t('translation', 'language.english_reference') ?></h2>
	</div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($language, 'code')->label('')->hiddenInput(); ?>
    <?php
    foreach ($language->sourceMessages as $sourceMessage) {

	$referenceMessage = webapp\models\Message::find()->where(['id' => $sourceMessage->id, 'language' => webapp\models\Language::REFERENCE_TRANSLATION_CODE])->one();

	$link = Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-source-message', 'id' => $sourceMessage->id, 'code' => $language->code], [
		    'data' => [
			'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
			'method' => 'post',
		    ],
		]) . '  ' . Html::tag("strong", $sourceMessage->message);

	$link = '<a href="#down"><span class="glyphicon glyphicon-arrow-down"></span></a> <a href="#up"><span class="glyphicon glyphicon-arrow-up"></span></a> ' . $link;
	?>

        <div class="row">
    	<div class="col-md-6">
	    <div class="<?php echo (empty($language->translations[$sourceMessage->id])?'has-error':'')?>">
		<?php 
		    $input = $form->field($language, 'translations[' . $sourceMessage->id . ']', [])->label($link);
		    if(strlen ($referenceMessage->translation) > 150){			
			echo $input->textarea(['rows'=>6]);
		    }else{
			echo $input->textInput();
		    }
		?>
	    </div>
    	</div><!-- /.col-lg-6 -->
    	<div class="col-md-6">
    	    <div class="panel panel-default">
    		<div class="panel-heading"><?= Html::tag("strong", $sourceMessage->message); ?></div>
    		<div class="panel-body">
			<?php echo $referenceMessage->translation ?>
    		</div>
    	    </div>
    	</div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <hr>

	<?php
    }
    ?>
    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['index'], ['class' => 'btn btn-primary']) ?>	
	<?= Html::submitButton(Yii::t('translation', 'language.save_messages_btn'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>    

</div>
<a id="down"></a>