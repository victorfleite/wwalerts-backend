<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Institution */

$this->title = Yii::t('translation', 'update_title', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'institutions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="institution-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
