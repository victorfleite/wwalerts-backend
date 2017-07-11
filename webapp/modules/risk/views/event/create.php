<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model webapp\modules\risk\models\Event */

$this->title = Yii::t('translation', 'Create Event');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
