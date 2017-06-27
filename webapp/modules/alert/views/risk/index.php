<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'Risks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('translation', 'Create Risk'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'i18n',
            'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'hash',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
