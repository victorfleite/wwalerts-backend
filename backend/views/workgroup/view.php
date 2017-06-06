<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Workgroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'workgroups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workgroup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class='text-right'>
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'workgroup.associate_users_btn'), ['workgroup/associate-users', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'workgroup.associate_jurisdiction_btn'), ['workgroup/associate-jurisdiction', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?=
	Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->id], [
	    'class' => 'btn btn-danger',
	    'data' => [
		'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
		'method' => 'post',
	    ],
	])
	?>
    </p>

    <?=
    DetailView::widget([
	'model' => $model,
	'attributes' => [
	    'name',
	    'description',
	    'created_at:datetime',
	],
    ])
    ?>
    
    <h1><?= Yii::t('translation', 'users') ?></h1>
    <?php
    $dataProvider = new ArrayDataProvider([
	'allModels' => $model->getUsers()->all(),
	'sort' => [
	    'attributes' => ['name'],
	],
	'pagination' => [
	    'pageSize' => 10,
	],
    ]);

    echo GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		 'name',
	    'username',
	    'email:email',
	    [
		'attribute' => 'created_at',
		'filter'=>null,
		'value' => function($data) {
		    $date = new \DateTime();
		    return $date->setTimestamp($data->created_at)->format('Y-m-d H:i:s');
		},
	    ],
	    [
		'attribute' => 'status',
		'filter'=>User::getStatusCombo(),
		'value' => function($data) {
		    return User::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'template' => '{view}',
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['user/view', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
    ?>
    
    <h1><?= Yii::t('translation', 'jurisdictions') ?></h1>
    <?php
    $dataProvider = new ArrayDataProvider([
	'allModels' => $model->getJurisdictions()->all(),
	'sort' => [
	    'attributes' => ['name'],
	],
	'pagination' => [
	    'pageSize' => 10,
	],
    ]);

    echo GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		[
		'attribute' => 'institution_id',
		'value' => 'institution.name',
	    ],
	    'name',
		[
		'attribute' => 'color',
		'format' => 'raw',
		'value' => function($data) {
		    return "<div style='background-color:" . $data->color . "'>&nbsp;</div>";
		},
	    ],
	    'created_at:datetime',
		[
		'class' => 'yii\grid\ActionColumn',
		'template' => '{view}',
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['jurisdiction/view', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
    ?>
    
    

</div>
