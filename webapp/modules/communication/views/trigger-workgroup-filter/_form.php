<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use webapp\modules\communication\models\Trigger;
use \common\components\widgets\modal_import_geometry\ModalImportGeometry;

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\TriggerGroupFilter */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="trigger-group-filter-form">

    <div class="alert alert-info">
	<p><strong><i class='fa fa-book'></i> <?php echo \Yii::t('translation', 'triggerworkgroupfilter.documentation'); ?></strong></p>
    </div>

    <h3><?php echo \Yii::t('translation', 'workgroup'); ?></h3>

    <?=
    DetailView::widget([
	'model' => $workgroup,
	'attributes' => [
	    //'id',
	    'name',
	    'description',
		[
		'attribute' => 'status',
		'value' => function($data) {

		    return webapp\modules\operative\models\Workgroup::getStatusLabel($data->status);
		},
	    ]
	],
    ])
    ?>

    <?php $form = ActiveForm::begin(); ?>    

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'workgroup_id')->hiddenInput()->label(false) ?>    

    <div class="row">
	<div class="col-lg-4">
	    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-6">
	    <?=
	    $form->field($model, 'trigger_id')->dropDownList(
		    ArrayHelper::map(Trigger::find()->select(['id', 'name'])->where(['type'=>Trigger::TYPE_INTERNAL])->orderBy('name')->all(), 'id', 'name')
		    , ['disabled' => (!$model->isNewRecord) ? True : False]);
	    ?>
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-2">
	    <?= $form->field($model, 'status')->dropDownList(webapp\modules\communication\models\TriggerWorkgroupFilter::getStatusCombo()); ?>
	</div><!-- /.col-lg-2 -->

    </div><!-- /.row -->
    <?=
	    $form->field($model, 'description')
	    ->textArea(['rows' => '4'])
    ?>
    <hr>
    <p class="text-right">

	<?php echo ModalImportGeometry::widget(['id' => 'import-local', 'outputField' => 'wkt', 'toggleButton' => ['label' => 'Importar Locais', 'class' => 'btn btn-primary']]); ?>

    </p>
    <?=
	    $form->field($model, 'geom')
	    ->label(\Yii::t('translation', 'triggerworkgroupfilter.geom') . ' (' . \Yii::t('translation', 'triggerworkgroupfilter.geom_hint') . ')')
	    ->textArea(['rows' => '6', 'id' => 'wkt'])
    ?>

    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/communication/workgroup/view', 'id' => $group->id], ['class' => 'btn btn-primary']) ?>
	<?php if (!$model->isNewRecord) { ?>	
	    <?= Html::a(Yii::t('translation', 'Preview'), ['/communication/trigger-workgroup-filter/view', 'workgroup_id' => $model->workgroup_id, 'trigger_id' => $model->trigger_id], ['class' => 'btn btn-warning']) ?>
	<?php } ?>	
	<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
