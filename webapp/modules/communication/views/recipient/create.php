<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Recipient */

$this->title = Yii::t('translation', 'recipient.create_title');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'recipients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipient-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
