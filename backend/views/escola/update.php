<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Escola */

$this->title = 'Escola';
$this->params['breadcrumbs'][] = ['label' => 'Escolas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="escola-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
