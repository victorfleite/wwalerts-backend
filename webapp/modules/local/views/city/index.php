<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'cities');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.local_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'city.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
	    'gid',
	    'name',
	    'latitude',
	    'longitude',
		[
		'attribute' => 'state_id',
		'value' => 'state.name',
	    ],
	    [
		'attribute' => 'country_id',
		'value' => 'country.name',
	    ],
	    // 'name',
	    // 'the_geom_s',
	    // 'geocode',
	    // 'geom',
	    // 'batch_id',
	    ['class' => 'yii\grid\ActionColumn'],
	],
    ]);
    ?>
</div>
