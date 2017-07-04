<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \common\models\Config;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'configs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
	    'varname',
		[
		'attribute' => 'value',
		'format'=>'raw',
		'value' => function ($model) {
		    switch ($model->varname) {
			case Config::VARNAME_COUNTRY_ID:
			    $country = \webapp\modules\local\models\Country::find()->where(['gid'=>$model->value])->one();
			    return $country->name;			
			case Config::VARNAME_JURISDICTION_DEFAULT_LAYER_COLOR:
			    return "<div style='background-color:{$model->value}'>{$model->value}</div>";
			default:
			    return $model->value;
		    }
		},
	    ],
		[
		'class' => 'yii\grid\ActionColumn',
		'template' => '{update}',
	    ],
	],
    ]);
    ?>

</div>
