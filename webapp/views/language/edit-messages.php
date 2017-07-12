<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\components\widgets\tooltip\Tooltip;

/* @var $this yii\web\View */
/* @var $model webapp\models\Language */

$this->title = $language->code . ' ( ' . $language->getTranslationPercentage() . '% )';
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>

    .tooltip-inner {
	max-width: 300px !important; 
    }

</style>
<a id="up"></a>
<div class="language-create">

    <h1><?= $this->title ?></h1>

    <?php echo $this->render('_create-source-message', ['language' => $language, 'model' => new webapp\models\SourceMessage()]); ?>     

    <hr>
    <br>

    <h2><?= Yii::t('translation', 'language.keys_available_title') ?></h2>

    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($language, 'code')->label('')->hiddenInput(); ?>
    <?php
    $generalVars = \Yii::$app->config->getVars();
    $referencelanguage = $generalVars[\common\models\Config::VARNAME_LANGUAGE_REFERENCE_TRANSLATION_CODE];
    $referencelanguage = (!empty($referencelanguage)) ? $referencelanguage : \webapp\models\Language::ENGLISH_TRANSLATION_CODE;
    $count = 1;
    foreach ($language->sourceMessages as $sourceMessage) {

	$referenceMessage = webapp\models\Message::find()->where(['id' => $sourceMessage->id, 'language' => $referencelanguage])->one();

	$link = Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-source-message', 'id' => $sourceMessage->id, 'code' => $language->code], [
		    'data' => [
			'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
			'method' => 'post',
		    ],
		]) . '  ' . Html::tag("strong", $sourceMessage->message);
	?>

        <div class="row">
    	<div class="col-md-12">
    	    <div class="<?php echo (empty($language->translations[$sourceMessage->id]) ? 'has-error' : '') ?>">
		    <?php
		    $input = $form->field($language, 'translations[' . $sourceMessage->id . ']', [])->label($link);
		    $tooltipOptions = [
			'toggle' => 'popover',
			'trigger'=> 'focus',
			'title' => Yii::t('translation', 'tooltip_header_reference_language', [
			    'language' => Yii::t('translation', 'language.' . $referencelanguage)
			]),
			'content' => $referenceMessage->translation,
		    ];
		    if (strlen($referenceMessage->translation) > 150) {
			$tooltipOptions['component'] = $input->textarea(['rows' => 6, 'tabindex'=> $count++]);
		    } else {
			$tooltipOptions['component'] = $input->textInput(['tabindex'=> $count++]);
		    }
		    echo Tooltip::widget($tooltipOptions);
		    ?>
    	    </div>
		<?= Html::submitButton(Yii::t('translation', 'language.save_messages_btn'), ['class' => 'btn btn-success btn-xs']) ?>
    	</div><!-- /.col-lg-12 -->
        </div>
        <hr>

	<?php
    }
    ?>
    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['index'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>    

</div>
<a id="down"></a>