<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Escola */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Escolas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="escola-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente apagar esta escola?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'endereco',
            'ddd1',
            'telefone1',
            'ddd2',
            'telefone2',
            'cidade',
            'uf',
            'cnpj',
            'nome_responsavel',
            'site',
            'email:email',
        ],
    ]) ?>

</div>
