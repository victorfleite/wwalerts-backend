<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskDescription */

$this->title = Yii::t('translation', 'event_risk_description.create_title');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'event_risk_descriptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-risk-description-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
