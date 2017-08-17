<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Behavior */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'behaviors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="behavior-view">

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
	    //'id',
	    'name',
		[
		'attribute' => 'class',
		'format' => 'raw',
		'value' => function ($model) {
		    return Html::a($model->class, \yii\helpers\Url::toRoute(['/communication/behavior/view-class', 'id' => $model->id], ['target' => '_blank']));
		},
	    ],
	    'description:ntext',
		[
		'attribute' => 'params',
		'format' => 'raw',
		'value' => function($data) {
		    return "<pre>" . $data->params . "</pre>";
		},
	    ],
	],
    ])
    ?>

</div>
