<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\City */

$this->title = Yii::t('translation', 'Update {modelClass}: ', [
    'modelClass' => 'City',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->gid]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
