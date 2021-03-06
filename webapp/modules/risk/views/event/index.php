<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'events');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'event.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		[
		'label' => Yii::t('translation', 'event.icon'),
		'format' => 'raw',
		'contentOptions' => ['class' => 'text-center'],
		'value' => function($data) {
		    return Html::a(Html::img($data->icon_path, ['width' => 40, 'height' => 40]), $data->icon_path, $options = ['target' => '_blank']);
		},
	    ],
		[
		'label' => Yii::t('translation', 'event.name_traduction'),
		'value' => function($data) {
		    return Yii::t('translation', $data->name_i18n);
		},
	    ],
	    'name_i18n',
	    'code',
	    //'i18n',
	    [
		'label' => Yii::t('translation', 'event.event_type_id'),
		'value' => function($data) {
		    return Yii::t('translation', $data->eventType->name_i18n);
		},
	    ],
	    'order',
	    //'created_by',
	    // 'updated_by',
	    // 'hash',
	    [
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\risk\models\Risk::getStatusLabel($data->status);
		},
	    ],
		['class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
	    ],
	],
    ]);
    ?>
</div>
