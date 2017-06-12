<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>
    
    <?= $form->field($model, 'state_id')->dropDownList(ArrayHelper::map(\webapp\modules\local\models\State::find()->select(['gid', 'name'])->orderBy('name')->all(), 'gid', 'name'), ['prompt' => '']);?>
    
    <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::map(\webapp\modules\local\models\Country::find()->select(['gid', 'name'])->orderBy('name')->all(), 'gid', 'name'), ['prompt' => '']);?>

    <?= $form->field($model, 'the_geom_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geocode')->textInput() ?>



    <?php /* $form->field($model, 'batch_id')->dropDownList(yii\helpers\ArrayHelper::map(webapp\modules\local\models\Batch::find()->orderBy('create_at desc'), 'id', 'created_at'), ['prompt' => '']); */ ?>

    <?=
	    $form->field($model, 'geom')
	    ->label(\Yii::t('translation', 'city.geom') . ' (' . \Yii::t('translation', 'city.geom_hint') . ')')
	    ->textArea(['rows' => '6', 'id' => 'wkt'])
    ?>

    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/local/city/index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
