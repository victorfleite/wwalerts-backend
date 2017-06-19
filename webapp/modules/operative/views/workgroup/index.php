<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'workgroups');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.operative_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workgroup-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'workgroup.create_title'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
	    'name',
		[
		'label' => \Yii::t('translation', 'jurisdictions'),
		'value' => function ($model) {
		    $names = [];
		    foreach ($model->getJurisdictions()->all() as $jurisdiction) {
			$names[] = $jurisdiction->name;
		    }	
		    return implode(', ', $names);
		},
	    ],
	    'created_at:datetime',
		[
		'class' => 'yii\grid\ActionColumn',
		'template' => '{view}{associate-user}{associate-jurisdiction}{update}{delete}',
		'buttons' => [
		    'associate-jurisdiction' => function ($url, $model) {
			return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
				    'title' => Yii::t('translation', 'workgroup.associate_jurisdiction_btn'),
			]);
		    },
		    'associate-user' => function ($url, $model) {
			return Html::a('<span class="glyphicon glyphicon-user"></span>', $url, [
				    'title' => Yii::t('translation', 'workgroup.associate_user_btn'),
			]);
		    }
		],
		'urlCreator' => function ($action, $model, $key, $index) {
		    if ($action === 'view') {
			return Url::to(['workgroup/view', 'id' => $model->id]);
		    }
		    if ($action === 'delete') {
			return Url::to(['workgroup/delete', 'id' => $model->id]);
		    }
		    if ($action === 'update') {
			return Url::to(['workgroup/update', 'id' => $model->id]);
		    }
		    if ($action === 'associate-jurisdiction') {
			return Url::to(['workgroup/associate-jurisdiction', 'id' => $model->id]);
		    }
		    if ($action === 'associate-user') {
			return Url::to(['workgroup/associate-user', 'id' => $model->id]);
		    }
		}
	    ],
	],
    ]);
    ?>
</div>
