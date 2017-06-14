<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'countries');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.local_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
       <?= Html::a(Yii::t('translation', 'country.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
	    'name',
	    'un',
	    //'lon',
            //'lat',
            //'fips',
            //'iso2',
            //'iso3',            
            // 'area',
            // 'pop2005',
            // 'region',
            // 'subregion',
            // 'lon',
            // 'lat',
            // 'geom',
            // 'batch_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
