<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Trigger */

$this->title = Yii::t('translation', 'trigger.create_title');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'triggers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="behavior-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
