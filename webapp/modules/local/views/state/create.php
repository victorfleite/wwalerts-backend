<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\State */

$this->title = Yii::t('translation', 'state.create_title');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.local_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'states'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
