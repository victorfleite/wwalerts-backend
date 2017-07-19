<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\widgets\datailview_i18n\DatailViewI18n;


/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventRiskDescription */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Event Risk Descriptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-risk-description-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_i18n',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'risk_id',
            'event_id',
            'hash',
        ],
    ]) ?>
    
    <h2><?= Yii::t('translation', 'translations') ?></h2>

    <?=
    DatailViewI18n::widget([
	'model' => $model,
	'attribute' => 'name_i18n',
    ])
    ?>

</div>
