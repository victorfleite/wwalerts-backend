<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskInstructionItem */

$this->title = Yii::t('translation', 'Update {modelClass}: ', [
    'modelClass' => 'Event Risk Instruction Item',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Event Risk Instruction Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="event-risk-instruction-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
