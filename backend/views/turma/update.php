<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Turma */

$this->title = 'Alterar Dados de Turma';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Turmas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Alterar Dados de Turma');
?>
<div class="turma-update">

    <h1>Alterar Dados de Turma</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
