<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'event_risk_instructions');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-risk-instruction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'event_risk_instruction.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		[
		'attribute' => 'event_id',
		'format' => 'raw',
		'contentOptions' => ['style' => 'vertical-align: middle'],
		'value' => function($data) {
		    return Html::img($data->event->icon_path, ['width' => 60, 'height' => 60]) . '&nbsp;&nbsp;' . Yii::t('translation', $data->event->name_i18n);
		},
	    ],
		[
		'attribute' => 'risk_id',
		'format' => 'raw',
		'contentOptions' => ['style' => 'vertical-align: middle'],
		'value' => function($data) {
		    return Html::tag('div', Yii::t('translation', $data->risk->name_i18n), ['style' => 'padding:10px; width:100%;border-radius: 10px; background-color:' . $data->risk->color]);
		},
	    ],
		[
		'label' => Yii::t('translation', 'event_risk_instruction.quantity_instructions'),
		'format' => 'raw',
		'contentOptions' => ['style' => 'vertical-align: middle', 'class'=>'text-right'],
		'value' => function($data) {
		    return Html::a($data->getEventRiskInstructionItens()->count(), yii\helpers\Url::toRoute(['view', 'id'=>$data->id]));		    
		},
	    ],
	    // 'hash',
	    ['class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right', 'style' => 'vertical-align: middle'],
	    ],
	],
    ]);
    ?>
</div>
