<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Turma */

$this->title = 'Visualizar Turma';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Turmas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turma-view">

    <h1>Visualizar Turma</h1>

    <p>
        <?= Html::a(Yii::t('app', 'Alterar Dados'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Apagar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Deseja realmente apagar esta turma?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idEscola.nome',
            'nome',
            'ano',
           
        ],
    ]) ?>

</div>
