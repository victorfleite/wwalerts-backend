<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Group */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'group.associate_recipient_btn'), ['group/associate-recipient', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?=
	Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->id], [
	    'class' => 'btn btn-danger',
	    'data' => [
		'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
		'method' => 'post',
	    ],
	])
	?>
    </p>

    <?=
    DetailView::widget([
	'model' => $model,
	'attributes' => [
	    //'id',
	    'name',
	    'description',
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\communication\models\Group::getStatusLabel($data->status);
		},
	    ]
	],
    ])
    ?>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'group.communication_filter_btn'), ['/communication/trigger-group-filter/create', 'group_id' => $model->id], ['class' => 'btn btn-primary']) ?>	
    </p>

    <h3><?= Yii::t('translation', 'group.communication_filter_title') ?></h3>
    <?php
    $filters = $model->getCommunicationFilters()->all();
    $dataProvider = new ArrayDataProvider([
	'allModels' => $filters,
	'sort' => [
	    'attributes' => ['name'],
	],
	'pagination' => [
	    'pageSize' => 10,
	],
    ]);

    echo GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		[
		'label' => \Yii::t('translation', 'triggergroupfilter.name'),
		'value' => function($data) {
		    return $data->name;
		},
	    ], [
		'label' => \Yii::t('translation', 'triggergroupfilter.trigger_id'),
		'value' => function($data) {
		    return $data->trigger->name;
		},
	    ],
		[
		'label' => \Yii::t('translation', 'triggergroupfilter.status'),
		'value' => function($data) {
		    return webapp\modules\communication\models\TriggerGroupFilter::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{view}{update}{delete}',
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['/communication/trigger-group-filter/view', 'group_id' => $model->group_id, 'trigger_id' => $model->trigger_id]);
		    }
		    if ($action === 'update') {
			return Url::to(['/communication/trigger-group-filter/update', 'group_id' => $model->group_id, 'trigger_id' => $model->trigger_id]);
		    }
		    if ($action === 'delete') {
			return Url::to(['/communication/trigger-group-filter/delete', 'group_id' => $model->group_id, 'trigger_id' => $model->trigger_id]);
		    }
		}
	    ],
	],
    ]);
    ?>

    <h3><?= Yii::t('translation', 'recipients') ?></h3>
    <?php
    $recipients = $model->getRecipients()->all();
    $dataProvider = new ArrayDataProvider([
	'allModels' => $recipients,
	'sort' => [
	    'attributes' => ['name'],
	],
	'pagination' => [
	    'pageSize' => 10,
	],
    ]);

    echo GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
	    'name',
	    'email',
	    'phone',
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\communication\models\Recipient::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{view}',
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['recipient/view', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
    ?>


</div>
