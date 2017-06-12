<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Workgroup */

$this->title = Yii::t('translation', 'workgroup.create_title');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'workgroups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workgroup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
