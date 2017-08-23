<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model webapp\modules\alert\models\Alert */

$this->title = Yii::t('translation', 'alert.create_title');
?>
<div class="alert-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
