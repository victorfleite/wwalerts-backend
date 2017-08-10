<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'risks');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'risk.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
	    'name_i18n',
		[
		'label' => Yii::t('translation', 'risk.name_traduction'),
		'value' => function($data) {
		    return Yii::t('translation', $data->name_i18n);
		},
	    ],
		[
		'attribute' => 'color',
		'format' => 'raw',
		'value' => function($data) {
		    return "<div style='background-color:" . $data->color . "'>&nbsp;</div>";
		},
	    ],
	    'code',
	    //'i18n',
	    'updated_at:datetime',
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\risk\models\Risk::getStatusLabel($data->status);
		},
	    ],
	    // 'updated_at',
	    // 'created_by',
	    // 'updated_by',
	    // 'hash',
	    ['class' => 'yii\grid\ActionColumn'],
	],
    ]);
    ?>
</div>
