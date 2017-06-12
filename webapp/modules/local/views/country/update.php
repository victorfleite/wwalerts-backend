<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Country */

$this->title = Yii::t('translation', 'Update {modelClass}: ', [
    'modelClass' => 'Country',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->gid]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
