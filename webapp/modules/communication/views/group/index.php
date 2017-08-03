<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'groups');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'group.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
	    'name',
		[
		'attribute' => 'description',
		'contentOptions' => ['class' => 'text-wrap'],
	    ],
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\communication\models\Group::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{view}{associate-recipient}{update}{delete}',
		'buttons' => [
		    'associate-recipient' => function ($url, $model) {
			return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
				    'title' => Yii::t('translation', 'group.associate_recipient_btn'),
			]);
		    },		    
		],
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['group/view', 'id' => $model->id]);
		    }
		    if ($action === 'delete') {
			return Url::to(['group/delete', 'id' => $model->id]);
		    }
		    if ($action === 'update') {
			return Url::to(['group/update', 'id' => $model->id]);
		    }
		    if ($action === 'associate-recipient') {
			return Url::to(['group/associate-recipient', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
    ?>
</div>
