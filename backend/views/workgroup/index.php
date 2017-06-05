<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'workgroups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workgroup-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a(Yii::t('translation', 'workgroup.create_title'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'created_at:datetime',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
