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
	    'name_i18n',
	    'updated_at:datetime',
	    // 'hash',
	    ['class' => 'yii\grid\ActionColumn'],
	],
    ]);
    ?>
</div>
