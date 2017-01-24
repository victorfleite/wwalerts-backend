<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Escola */

$this->title = 'Nova Escola';
$this->params['breadcrumbs'][] = ['label' => 'Escolas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="escola-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
