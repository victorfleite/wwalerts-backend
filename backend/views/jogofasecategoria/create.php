<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JogoFaseCategoria */

$this->title = Yii::t('app', 'Nova Categoria');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jogo-fase-categoria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
