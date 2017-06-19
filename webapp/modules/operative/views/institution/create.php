<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Institution */

$this->title = Yii::t('translation', 'institution.create_title');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.operative_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'institution'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
