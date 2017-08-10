<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\widgets\datailview_i18n\DatailViewI18n;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\EventType */

$this->title = Yii::t('translation', $model->name_i18n);
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'eventtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>        
    </p>

    <?=
    DetailView::widget([
	'model' => $model,
	'attributes' => [
	    'name_i18n',
	    'description_i18n',
	    'abbrev',
		[
		'attribute' => 'status',
		'value' => function($data) {
		    return webapp\modules\risk\models\EventType::getStatusLabel($data->status);
		},
	    ]
	],
    ])
    ?>

    <h2><?= Yii::t('translation', 'translations') ?></h2>

    <?=
    DatailViewI18n::widget([
	'model' => $model,
	'attribute' => 'name_i18n',
    ])
    ?>

    <?=
    DatailViewI18n::widget([
	'model' => $model,
	'attribute' => 'description_i18n',
    ])
    ?>

</div>
