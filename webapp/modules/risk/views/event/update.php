<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\Event */

$this->title = Yii::t('translation', 'update_title', [
    'name' => Yii::t('translation', $model->name_i18n),
]);
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.risk_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', $model->name_i18n), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
