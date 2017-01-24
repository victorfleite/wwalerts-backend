<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EscolaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Escolas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="escola-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Escola', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'endereco',
            'ddd1',
            'telefone1',
            // 'ddd2',
            // 'telefone2',
            // 'cidade',
            // 'uf',
            // 'cnpj',
            // 'nome_responsavel',
            // 'site',
            // 'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
