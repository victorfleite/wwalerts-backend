<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'event_types');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		[
		'label' => Yii::t('translation', 'event_type.name_traduction'),
		'value' => function($data) {
		    return Yii::t('translation', $data->name_i18n);
		},
	    ],
	    'name_i18n',
	    'abbrev',
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\risk\models\EventType::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['class' => 'text-right'],
		'template' => '{update}',
	    ],
	],
    ]);
    ?>
</div>
