<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Behavior */

$this->title = Yii::t('translation', 'Update {modelClass}: ', [
    'modelClass' => 'Behavior',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Behaviors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="behavior-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
