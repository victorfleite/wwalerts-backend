<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Recipient */
$name = (!empty($model->name))? $model->name: $model->email;
$this->title = Yii::t('translation', 'update_title', [
    'name' => $name,
]);
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'recipients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="recipient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
