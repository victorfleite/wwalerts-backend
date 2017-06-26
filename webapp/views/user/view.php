<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

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
	<?= Html::a(Yii::t('translation', 'user.btn_add_role'), \yii\helpers\Url::toRoute(['admin/assignment/view', 'id' => $model->id]), ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    DetailView::widget([
	'model' => $model,
	'attributes' => [
	    'name',
	    'username',
	    'email',
		[
		'label' => \Yii::t('translation', 'user.roles'),
		'format' => 'raw',
		'value' => function($model) {
		    $roles = \Yii::$app->authManager->getRolesByUser($model->id);
		    $links = [];
		    if (is_array($roles)) {
			foreach ($roles as $role) {
			    $links[] = Html::a($role->name, \yii\helpers\Url::toRoute(['admin/assignment/view', 'id' => $model->id]));
			}
		    }
		    return implode(' ,', $links);
		},
	    ],
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
		    return User::getStatusLabel($data->status);
		},
	    ],
	],
    ])
    ?>

</div>
