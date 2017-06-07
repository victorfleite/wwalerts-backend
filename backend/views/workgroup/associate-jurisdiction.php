<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use \backend\models\Jurisdiction;
use softark\duallistbox\DualListbox;

/* @var $this yii\web\View */
/* @var $model backend\models\Workgroup */
$this->title = Yii::t('translation', 'workgroup.associate_jurisdiction_title');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'workgroups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $workgroup->name, 'url' => ['view', 'id' => $workgroup->id]];
$this->params['breadcrumbs'][] = $this->title
?>
<div class="grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class='text-right'>
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $workgroup->id], ['class' => 'btn btn-primary']) ?>
    </p>



    <?=
    DetailView::widget(['model' => $workgroup, 'attributes' => ['name', 'description']]);
    $form = ActiveForm::begin();
    ?>
    <div>

	<?php
	$options = [
	    'multiple' => true,
	    'size' => 20,
	];
	$jurisdictionsAvailable = Jurisdiction::find()->orderBy('name')->asArray()->all();
	$items = ArrayHelper::map($jurisdictionsAvailable, 'id', 'name');
	// echo $form->field($model, $attribute)->listBox($items, $options);
	echo $form->field($model, 'jurisdictions')->widget(DualListbox::className(), [
	    'items' => $items,
	    'options' => $options,
	    'clientOptions' => [
		'moveOnSelect' => false,
		'selectedListLabel' => Yii::t('translation', 'workgroup.selected'),
		'nonSelectedListLabel' => Yii::t('translation', 'workgroup.available'),
	    ],
	]);
	?>

    </div>
    <p>&nbsp;</p>
    <div class="form-group">
	<?= Html::submitButton(Yii::t('translation', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>


</div>