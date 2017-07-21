<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'behaviors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="behavior-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a(Yii::t('translation', 'behavior.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'class',
            //'params:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
