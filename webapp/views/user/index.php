<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'user.list_title');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php /* echo $this->render('_search', ['model' => $searchModel]); */ ?>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'user.btn_create'), ['signup'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
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
	    //'password_hash',
	    //'password_reset_token',
	    // 'status',
	    // 'created_at',
	    // 'updated_at',
	    [
		'class' => 'yii\grid\ActionColumn',
		'template' => '{view}{update}',
	    ],
	],
    ]);
    ?>
</div>
