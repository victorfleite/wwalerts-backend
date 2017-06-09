<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\City */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->gid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->gid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gid',
            'latitude',
            'longitude',
            'id',
            'state_id',
            'name',
            'the_geom_s',
            'geocode',
            'geom',
            'batch_id',
        ],
    ]) ?>

</div>
