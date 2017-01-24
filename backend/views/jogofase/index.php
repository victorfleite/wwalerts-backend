<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JogofaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fases dos Jogos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jogo-fase-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Nova Fase'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'jogo.nome',
            'nome',
            [
              'attribute' => 'tagNames',
              'value' => function ($model) {
                return implode(', ',$model->getTagList());
              },
            ],           
            //'descricao:raw',
            //'habilidades:ntext',
            // 'faixa:ntext',
            // 'momento:ntext',
            // 'como_usar:ntext',
            // 'acesso:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
