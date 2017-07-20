<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskInstruction */

$this->title = Yii::t('translation', 'update_title', [
    'name' => $model->name_i18n,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'event_risk_instructions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_i18n, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="event-risk-instruction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
