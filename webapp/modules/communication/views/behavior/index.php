<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->title = Yii::t('translation', 'behaviors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="behavior-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
    <?= Html::a(Yii::t('translation', 'behavior.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
	    //'id',
	    'name',
		[
		'attribute' => 'class',
		'format' => 'raw',
		'value' => function ($model) {
		    return Html::a($model->class, \yii\helpers\Url::toRoute(['/communication/behavior/view-class', 'id' => $model->id], ['target' => '_blank']));
		},
	    ],
	    //'params:ntext',
	    ['class' => 'yii\grid\ActionColumn'],
	],
    ]);
    ?>
</div>
