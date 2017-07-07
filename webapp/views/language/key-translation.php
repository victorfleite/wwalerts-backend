<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model webapp\models\Language */
/* @var $form yii\widgets\ActiveForm */
?>

<div id='key-translation-content'>
    <h1><?= \Yii::t('translation', 'key') . ': ' . $sourceMessage->message ?></h1>
    <?php $form = ActiveForm::begin(['options' => ['id' => 'translation-form']]); ?>

    <?php foreach ($inputs as $languageCode => $value) { ?>
        <div class="form-group">
    	<label><?= \Yii::t('translation', 'language.' . $languageCode) ?></label>
	    <?php if ($fieldType == 'textarea') { ?>
		<?= Html::textarea('translation[' . $languageCode . ']', $value, ['class' => "form-control", 'rows' => (!empty($options['rows']) ? $options['rows'] : 6)]) ?>
	    <?php } else { ?>
		<?= Html::textInput('translation[' . $languageCode . ']', $value, ['class' => "form-control"]) ?>
	    <?php } ?>
        </div>
    <?php } ?>
    <div class="form-group">
	<?= Html::button('Salvar', ['class' => 'btn btn-success', 'id' => 'save-translation']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script>
	$(function () {
	    $('#save-translation').click(function () {
		var url = '<?= yii\helpers\Url::toRoute(['key-translation-update', 'message' => $sourceMessage->message, 'fieldType' => $fieldType, 'rows' => $options['rows']]) ?>'
		$.ajax({
		    type: 'POST',
		    beforeSend: function (request) {
			request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			request.setRequestHeader('Accept', 'text/html');
		    },
		    url: url,
		    data: $('#translation-form').serialize(),
		    success: function (data) {

			$('#key-translation-content').html(data);

		    },
		});


	    });
	});
    </script>
</div>    




