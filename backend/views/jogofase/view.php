<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JogoFase */

$this->title = "Fase do Jogo";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jogo Fases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jogo-fase-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Atualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Apagar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Deseja realmente apagar esta fase?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'jogo.nome',
            'nome',
            [ 
            'label' => $model->getAttributeLabel('tagNames'),
            'value' => implode(', ',$model->getTagList())
            ],
            'descricao:raw',
            'objetivo_jogo:raw',
            'objetivo_pedagogico:raw',
            'regra_jogo:raw',
            'exemplo:raw',
            'habilidades:raw',
            'disciplina:raw',
            'indicacao:raw',
            'acesso:raw'
        ],
    ]) ?>

</div>
