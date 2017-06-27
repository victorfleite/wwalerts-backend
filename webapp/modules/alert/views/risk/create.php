<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\alert\models\Risk */

$this->title = Yii::t('translation', 'Create Risk');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Risks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
