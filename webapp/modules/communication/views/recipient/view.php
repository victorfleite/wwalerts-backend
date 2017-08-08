<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Recipient */
$name = (!empty($model->name))? $model->name: $model->email;
$this->title = $name;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'recipients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipient-view">

    <h1><?= Html::encode($this->title) ?></h1>

     <p class="text-right">
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
            'name',
            'email',
            'phone',
            [
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\communication\models\Recipient::getStatusLabel($data->status);
		},
	    ],
        ],
    ]) ?>
    
    
    <h3><?= Yii::t('translation', 'groups') ?></h3>
    <?php
    $groups = $model->getGroups()->all();
    $dataProvider = new ArrayDataProvider([
	'allModels' => $groups,
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
		[
		'attribute' => 'description',
		'contentOptions' => ['class' => 'text-wrap'],
	    ],
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\communication\models\Group::getStatusLabel($data->status);
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'template' => '{view}',
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['group/view', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
    ?>

</div>
