<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'recipients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipient-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a(Yii::t('translation', 'recipient.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email',
            'phone',
            [
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\communication\models\Recipient::getStatusLabel($data->status);
		},
	    ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
