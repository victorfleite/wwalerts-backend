<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\City */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.local_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->gid], ['class' => 'btn btn-primary']) ?>
	<?=
	Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->gid], [
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
	    'gid',
	    'name',
	    'latitude',
	    'longitude',
		[
		'attribute' => 'state_id',
		'value' => function($data) {
		    $state = \webapp\modules\local\models\State::findOne($data->state_id);
		    return $state->name;
		},
	    ],
		[
		'attribute' => 'country_id',
		'value' => function($data) {
		    $country = \webapp\modules\local\models\Country::findOne($data->country_id);
		    return $country->name;
		},
	    ],
	    'the_geom_s',
	    'geocode',
		[
		'attribute' => 'geom',
		'value' => function($data) {
		    return \common\models\Util::removeMiddleOfString($data->geom, 120);
		},
	    ],
	],
    ])
    ?>

</div>
