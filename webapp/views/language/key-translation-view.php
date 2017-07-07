<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model webapp\models\Language */
/* @var $form yii\widgets\ActiveForm */
?>

<div id='key-translation-content'>
    <h1><?= \Yii::t('translation', 'key') . ': ' . $sourceMessage->message ?></h1>

    <p class="text-right">
	<?= Html::button(Yii::t('translation', 'language.modal_edit_key_translation_btn'), ['id' => 'edit-key-translation', 'class' => 'btn btn-success']) ?>
    </p>

    <?=
    ListView::widget([
	'dataProvider' => $languageProvider,
	'options' => [
	    'tag' => 'div',
	    'class' => 'list-wrapper',
	    'id' => 'list-wrapper',
	],
	'layout' => "{items}",
	'itemView' => function ($model, $key, $index, $widget) {
	    return $this->render('@common/components/widgets/inputmodal_i18n/views/_list_item', ['model' => $model]);
	},
    ]);
    ?>

    <script>
	$(function () {
	    $('#edit-key-translation').click(function () {
		var url = '<?= yii\helpers\Url::toRoute(['key-translation-update', 'message' => $sourceMessage->message, 'fieldType' => $fieldType, 'rows' => $options['rows']]) ?>'
		$.ajax({
		    type: 'GET',
		    beforeSend: function (request) {
			request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			request.setRequestHeader('Accept', 'text/html');
		    },
		    url: url,
		    success: function (data) {

			$('#key-translation-content').html(data);

		    },
		});


	    });
	});
    </script>	

</div>


