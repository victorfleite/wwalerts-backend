<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model webapp\modules\alert\models\Alert */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Alerts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alert-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?=
	Html::a(Yii::t('translation', 'Cancel'), ['cancel', 'id' => $model->id], [
	    'class' => 'btn btn-danger',
	    'data' => [
		'confirm' => Yii::t('translation', 'alert.confirm_message_cancel'),
		'method' => 'post',
	    ],
	])
	?>
    </p>

    <div>
    <?= Html::a(Html::img($model->map_file, ['class' => 'img-thumbnail']), $model->map_file, ['target' => '_blank']) ?>
    </div>
    <br>
    <?=
    DetailView::widget([
	'model' => $model,
	'attributes' => [
	    'id',
	    'event_id',
	    'risk_id',
	    //'geom',
	    'created_at',
	    'start',
	    'end',
	    'alert_status_id',
	    'map_file',
	    'hash',
	    'cap_id',
	    'updated_at',
	    'created_by',
	    'updated_by',
	    'canceled'
	],
    ])
    ?>

</div>
