<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a(Yii::t('translation', 'event.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
	    [
		'label' => Yii::t('translation', 'event.icon_path'),
		'format' => 'raw',
		'value' => function($data) {
		    return Html::a(Html::img($data->icon_path), $data->icon_path, $options = ['target' => '_blank']);
		},
	    ],

             'name_i18n',
            [
		'label' => Yii::t('translation', 'event.name_traduction'),
		'value' => function($data) {
		    return Yii::t('translation', $data->name_i18n);
		},
	    ],
            //'i18n',
            'updated_at:datetime',
            [
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\risk\models\Risk::getStatusLabel($data->status);
		},
	    ], 	
            //'created_by',
            // 'updated_by',
            // 'hash',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
