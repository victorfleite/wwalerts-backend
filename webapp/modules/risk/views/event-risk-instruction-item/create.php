<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskInstructionItem */

$this->title = Yii::t('translation', 'Create Event Risk Instruction Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Event Risk Instruction Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-risk-instruction-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
