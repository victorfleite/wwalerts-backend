<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\widgets\datailview_i18n\DatailViewI18n;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskDescription */

$this->title = $model->name_i18n;
$this->params['breadcrumbs'][] = ['label' => $model->name_i18n, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-risk-description-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
	    'name_i18n',
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

    <h2><?= Yii::t('translation', 'translations') ?></h2>

    <?=
    DatailViewI18n::widget([
	'model' => $model,
	'attribute' => 'name_i18n',
    ])
    ?>

</div>
