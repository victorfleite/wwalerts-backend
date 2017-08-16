<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\widgets\datailview_i18n\DatailViewI18n;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskInstructionItem */

$this->title = $model->description_i18n;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'event_risk_instruction_item'), 'url' => ['event-risk-instruction/view', 'id' => $model->event_risk_instruction_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-risk-instruction-item-view">

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
	    //'id',
	    'description_i18n',
	    'order',
	    [
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\risk\models\EventRiskInstructionItem::getStatusLabel($data->status);
		},
	    ]
	    
	],
    ])
    ?>

    <h2><?= Yii::t('translation', 'translations') ?></h2>

    <?=
    DatailViewI18n::widget([
	'model' => $model,
	'attribute' => 'description_i18n',
    ])
    ?>

</div>
