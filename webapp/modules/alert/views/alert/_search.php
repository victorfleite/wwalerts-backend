<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use webapp\modules\alert\models\AlertStatus;

/* @var $this yii\web\View */
/* @var $model webapp\modules\alert\models\AlertSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alert-search">

    <?php
    $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'event_id') ?>

    <?= $form->field($model, 'risk_id') ?>

    <?= $form->field($model, 'geom') ?>

    <?= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'start')  ?>

    <?php // echo $form->field($model, 'end')  ?>

    <?php // echo $form->field($model, 'alert_status_id')  ?>

    <?php // echo $form->field($model, 'map_file')  ?>

    <?php // echo $form->field($model, 'hash')  ?>

    <?php // echo $form->field($model, 'cap_id')  ?>

    <?php // echo $form->field($model, 'updated_at')  ?>

    <?php // echo $form->field($model, 'created_by')  ?>

<?php // echo $form->field($model, 'updated_by')  ?>

    <div class="form-group">
<?= Html::submitButton(Yii::t('translation', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>


<div class="city-search">

    <?php
    $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
    ]);
    ?>

    <?php
    echo Form::widget([// 1 column layout
	'model' => $model,
	'form' => $form,
	'columns' => 3,
	'attributes' => [
	    'event_id' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => \webapp\modules\risk\models\Event::getTranslatedComboArray('id', 'name_i18n', [], ['order'=>SORT_ASC]),
		'options' => [
		    'prompt' => \Yii::t('translation', 'alert.all_events')
		]],
	    'risk_id' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => \webapp\modules\risk\models\Risk::getTranslatedComboArray('id', 'name_i18n', [], ['order'=>SORT_ASC]),
		'options' => [
		    'prompt' => \Yii::t('translation', 'alert.all_risks')
		]],
	    'alert_status_id' => ['type' => Form::INPUT_DROPDOWN_LIST,
		'items' => AlertStatus::getTranslatedComboArray('id', 'name_i18n', ['status' => AlertStatus::STATUS_ACTIVE], ['order'=>SORT_ASC]),
		'options' => [
		    'prompt' => \Yii::t('translation', 'alert.all_status')
		]],
	]
    ]);
    ?>


    <div class="form-group">
    <?= Html::submitButton(Yii::t('translation', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>