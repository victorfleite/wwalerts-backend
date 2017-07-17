<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\Event */

$this->title = Yii::t('translation', $model->name_i18n);
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
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
		'label' => Yii::t('translation', 'event.icon'),
		'format' => 'raw',
		'value' => function($data) {
		    return Html::a(Html::img($data->icon_path), $data->icon_path, $options = ['target' => '_blank']);
		},
	    ],
		[
		'label' => Yii::t('translation', 'event.icon_path'),
		'format' => 'raw',
		'value' => function($data) {
		    return Html::a($data->icon_path, $data->icon_path, $options = ['target' => '_blank']);
		},
	    ],
	    'name_i18n',
	    'description_i18n',
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
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\risk\models\Event::getStatusLabel($data->status);
		},
	    ],
	],
    ])
    ?>

</div>
