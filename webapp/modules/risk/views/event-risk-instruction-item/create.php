<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskInstructionItem */

$this->title = Yii::t('translation', 'event_risk_instruction_item.create_title');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'event_risk_instruction_item'), 'url' => ['event-risk-instruction/view', 'id'=>$eventRiskInstruction->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-risk-instruction-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
	'eventRiskInstruction' => $eventRiskInstruction
    ]) ?>

</div>
