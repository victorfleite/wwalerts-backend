<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\TriggerGroupFilter */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'workgroups'), 'url' => ['/operative/workgroup/index']];
$this->params['breadcrumbs'][] = ['label' => $workgroup->name, 'url' => ['/operative/workgroup/view', 'id' => $workgroup->id]];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="trigger-workgroup-filter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,	
	'workgroup' => $workgroup,
    ]) ?>

</div>
