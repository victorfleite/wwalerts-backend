<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Institution */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'institutions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class='text-right'>
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->id], [
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
            'abbreviation',
	    'name',
	    'country',
            'email:email',
            'phone',           
            // CAP
            'abbreviation_cap',
            'sender_cap',
            'contact_cap',
            'language_cap',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
