<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model webapp\modules\alert\models\Alert */

$this->title = Yii::t('translation', 'Update {modelClass}: ', [
    'modelClass' => 'Alert',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Alerts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="alert-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
