<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = Yii::t('translation', 'Update {modelClass}: ', [
    'modelClass' => 'Region',
]) . $model->gid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gid, 'url' => ['view', 'id' => $model->gid]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="region-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
