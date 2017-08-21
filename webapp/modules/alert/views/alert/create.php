<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model webapp\modules\alert\models\Alert */

$this->title = Yii::t('translation', 'Create Alert');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Alerts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alert-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
