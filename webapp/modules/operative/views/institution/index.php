<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'institutions');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.operative_menu_label');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a(Yii::t('translation', 'institution.create_btn'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
	    'abbreviation',
	    'name',
            'email:email',
            'phone',            
            'country',
            // 'abbreviation_cap',
            // 'sender_cap',
            // 'contact_cap',
            // 'language_cap',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
