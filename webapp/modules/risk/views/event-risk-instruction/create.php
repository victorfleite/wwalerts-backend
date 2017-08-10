<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskInstruction */

$this->title = Yii::t('translation', 'event_risk_instruction.create_title');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'event_risk_instructions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-risk-instruction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
