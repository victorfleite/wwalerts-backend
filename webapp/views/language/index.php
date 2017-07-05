<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'languages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'language.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
	    'code',
	    [
		'label' => Yii::t('translation', 'language'),
		'value' => function ($model) {
		    return Yii::t('translation', 'language.'. $model->code);
		},
	    ],
		[
		'label' => Yii::t('translation', 'language.translation_percent'),
		'format' => 'raw',
		'value' => function ($model) {
		    return Html::a($model->getTranslationPercentage() . "%", \yii\helpers\Url::toRoute(['language/edit-messages', 'code' => $model->code]));
		},
	    ],
		[
		'attribute' => 'status',
		'value' => function ($model) {
		    return webapp\models\Language::getStatusLabel($model->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{toggle}{edit-messages}',
		'buttons' => [
		    'toggle' => function ($url, $model) {
			return Html::a('<span class="glyphicon glyphicon glyphicon-ok"></span>', $url, [
				    'title' => Yii::t('translation', 'language.toggle_status_btn'),
			]);
		    },
		    'edit-messages' => function ($url, $model) {
			return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
				    'title' => Yii::t('translation', 'language.edit_messages_btn'),
			]);
		    },
		],
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'toggle') {
			return Url::to(['language/toggle-status', 'id' => $model->id]);
		    }
		    if ($action === 'edit-messages') {
			return Url::to(['language/edit-messages', 'code' => $model->code]);
		    }
		}
	    ],
	],
    ]);
    ?>
</div>
