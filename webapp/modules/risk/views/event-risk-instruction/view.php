<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use \common\components\widgets\tooltip\Tooltip;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskInstruction */

$this->title = Yii::t('translation', $model->event->name_i18n) . ' - ' . Yii::t('translation', $model->risk->name_i18n);
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-risk-instruction-view">

    <h1><span style="background-color: <?= $model->risk->color ?>; padding: 15px; vertical-align: middle; border-radius: 10px;"><?= Html::img($model->event->icon_path, ['width' => 60, 'height' => 60]); ?>   <?= $this->title ?></span></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
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
		[
		'attribute' => 'event_id',
		'value' => function($data) {
		    return Yii::t('translation', $data->event->name_i18n);
		},
	    ],
		[
		'attribute' => 'risk_id',
		'value' => function($data) {
		    return Yii::t('translation', $data->risk->name_i18n);
		},
	    ],
	    'created_at:datetime',
	    'updated_at:datetime',
		[
		'attribute' => 'created_by',
		'value' => function($data) {
		    $user = \common\models\User::findOne($data->created_by);
		    return $user->name;
		},
	    ],
		[
		'attribute' => 'updated_by',
		'value' => function($data) {
		    $user = \common\models\User::findOne($data->updated_by);
		    return $user->name;
		},
	    ],
	    'hash',
	],
    ])
    ?>

    <h2><?= Yii::t('translation', 'event_risk_instruction.itens_label') ?></h2>	
    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'event_risk_instruction_item.create_btn'), ['event-risk-instruction-item/create', 'event_risk_instruction_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php
    $itens = $model->getEventRiskInstructionItens()->all();
    $dataProvider = new ArrayDataProvider([
	'allModels' => $itens,
	'sort' => [
	    'attributes' => ['description_i18n', 'order'],
	],
	'pagination' => [
	    'pageSize' => 10,
	],
    ]);
    echo GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		[
		'attribute' => 'description_i18n',
		'format' => 'raw',
		'value' => function($data) {

		    $tooltipOptions = [
			'toggle' => 'popover',
			'trigger' => 'hover',
			'title' => Yii::t('translation', 'event_risk_instruction.item'),
			'content' => Yii::t('translation', $data->description_i18n),
		    ];
		    $field = Html::a($data->description_i18n, Url::to(['/risk/event-risk-instruction-item/view', 'id' => $data->id]), $options = [/* 'target' => '_blank' */]);
		    $tooltipOptions['component'] = $field;
		    return Tooltip::widget($tooltipOptions);
		},
	    ],
	    /* [
	      'label' => Yii::t('translation', 'event_risk_instruction_item.description_i18n_label'),
	      'value' => function($data) {
	      return Yii::t('translation', $data->description_i18n);
	      },
	      ], */
	    'order',
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\risk\models\EventRiskInstructionItem::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{view}{update}{delete}',
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['/risk/event-risk-instruction-item/view', 'id' => $model->id]);
		    }
		    if ($action === 'update') {
			return Url::to(['/risk/event-risk-instruction-item/update', 'id' => $model->id]);
		    }
		    if ($action === 'delete') {
			return Url::to(['/risk/event-risk-instruction-item/delete', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
    ?>


</div>
