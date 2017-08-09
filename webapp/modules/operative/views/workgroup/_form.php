<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Workgroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workgroup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>
    <div class="row">
	<div class="col-lg-8">
	    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	</div><!-- /.col-lg-8 -->
	<div class="col-lg-4">
	    <?= $form->field($model, 'status')->dropDownList(webapp\modules\operative\models\Workgroup::getStatusCombo()); ?>
	</div><!-- /.col-lg-4 -->

    </div><!-- /.row -->

    <?= $form->field($model, 'description')
	    ->textArea(['rows' => '6'])
    ?>

    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/operative/workgroup/index'], ['class' => 'btn btn-primary']) ?>	
<?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
