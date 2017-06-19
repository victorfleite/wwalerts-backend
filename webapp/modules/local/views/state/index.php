<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'states');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.local_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a(Yii::t('translation', 'state.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
	     array(
		'label' => Yii::t('translation', 'state.icon'),
		'format' => 'raw',
		'value' => function($data) {
		    return Html::a( Html::img($data->iconPathUrl), $data->iconPathUrl, $options = ['target'=>'_blank'] );
		},
	    ),
	    'abbreviati',
            'name',
            [
		'attribute' => 'country_id',
		'value' => 'country.name',
	    ],
            //'center_lat',
            //'center_lon',
            // 'abbreviati',
            // 'icon_path',
            // 'cd_geocodu',
            // 'geom',
            // 'batch_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
