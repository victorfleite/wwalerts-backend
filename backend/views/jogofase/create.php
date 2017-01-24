<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JogoFase */

$this->title = Yii::t('app', 'Nova Fase');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jogo-fase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
