<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'user.btn_manage'), ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'user.btn_update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    DetailView::widget([
	'model' => $model,
	'attributes' => [
	    'name',
	    'username',
	    'email:email',
	    [
		'attribute' => 'created_at',
		'value' => function($data) {
		    $date = new \DateTime();
		    return $date->setTimestamp($data->created_at)->format('Y-m-d H:i:s');
		},
	    ],
	    [
		'attribute' => 'updated_at',
		'filter' => null,
		'value' => function($data) {
		    $date = new \DateTime();
		    return $date->setTimestamp($data->created_at)->format('Y-m-d H:i:s');
		},
	    ],
	    [
		'attribute' => 'status',
		'value' => function($data) {
		    return $data->getStatusLabel();
		},
	    ],
	],
    ])
    ?>

</div>
