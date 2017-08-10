<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use webapp\modules\communication\models\Trigger;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->title = Yii::t('translation', 'trigger');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="behavior-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'trigger.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
	    //'id',
	    'name',
		[
		'attribute' => 'type',
		'value' => function($data) {
		    return \webapp\modules\communication\models\Trigger::getTypeLabel($data->type);
		},
	    ],
		[
		'attribute' => 'behavior_id',
		'value' => function($data) {
		    return $data->behaviorTrigger->name;
		},
	    ],
		[
		'attribute' => 'event_id',
		'value' => function($data) {
		    if (empty($data->event)) {
			return \Yii::t('translation', 'trigger.all_events');
		    }
		    return Yii::t('translation', $data->event->name_i18n);
		},
	    ],
		[
		'attribute' => 'risk_id',
		'value' => function($data) {
		    if (empty($data->risk)) {
			return \Yii::t('translation', 'trigger.all_risks');
		    }
		    return Yii::t('translation', $data->risk->name_i18n);
		},
	    ],
		[
		'attribute' => 'alert_status_id',
		'value' => function($data) {
		     if (empty($data->alertStatus)) {
			return \Yii::t('translation', 'trigger.all_alerts_status');
		    }
		    return Yii::t('translation', $data->alertStatus->name_i18n);
		},
	    ],
		[
		'label' => \Yii::t('translation', 'trigger.groups'),
		'format' => 'raw',
		'value' => function ($model) {
		    $links = [];

		    if ($model->type == Trigger::TYPE_EXTERNAL) {
			foreach ($model->getGroups()->all() as $group) {
			    $links[] = Html::a($group->name, \yii\helpers\Url::toRoute(['/communication/group/view', 'id' => $group->id]));
			}
		    }
		    if ($model->type == Trigger::TYPE_INTERNAL) {
			foreach ($model->getWorkgroups()->all() as $workgroup) {
			    $links[] = Html::a($workgroup->name, \yii\helpers\Url::toRoute(['/operative/workgroup/view', 'id' => $workgroup->id]));
			}
		    }
		    return implode(', ', $links);
		},
	    ],
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\communication\models\Trigger::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{view}{associate-group}{update}{delete}',
		'buttons' => [
		    'associate-group' => function ($url, $model) {
			return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
				    'title' => Yii::t('translation', 'trigger.associate_group_btn'),
			]);
		    },
		],
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['trigger/view', 'id' => $model->id]);
		    }
		    if ($action === 'delete') {
			return Url::to(['trigger/delete', 'id' => $model->id]);
		    }
		    if ($action === 'update') {
			return Url::to(['trigger/update', 'id' => $model->id]);
		    }
		    if ($action === 'associate-group') {
			return Url::to(['trigger/associate-group', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
    ?>
</div>
