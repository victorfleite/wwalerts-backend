<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use webapp\modules\communication\models\Recipient;
use softark\duallistbox\DualListbox;

/* @var $this yii\web\View */
/* @var $model backend\models\Workgroup */
$this->title = Yii::t('translation', 'recipient.associate_recipient_title');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['view', 'id' => $group->id]];
$this->params['breadcrumbs'][] = $this->title
?>
<div class="grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class='text-right'>
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $group->id], ['class' => 'btn btn-primary']) ?>
    </p>


    <h3><?= Yii::t('translation', 'group') ?></h3>
    <?=
    DetailView::widget(['model' => $group, 'attributes' => ['name', 'description']]);
    $form = ActiveForm::begin();
    ?>
    <h3><?= Yii::t('translation', 'recipient') ?></h3>
    <div>

	<?php
	$options = [
	    'multiple' => true,
	    'size' => 20,
	];
	$recipientsAvailable = Recipient::find()->orderBy('email')->asArray()->all();
	$items = ArrayHelper::map($recipientsAvailable, 'id', 'email');
	// echo $form->field($model, $attribute)->listBox($items, $options);
	echo $form->field($model, 'recipients')->label('')->widget(DualListbox::className(), [
	    'items' => $items,
	    'options' => $options,
	    'clientOptions' => [
		'moveOnSelect' => false,
		'selectedListLabel' => Yii::t('translation', 'group.selected'),
		'nonSelectedListLabel' => Yii::t('translation', 'group.available'),
	    ],
	]);
	?>

    </div>
    <p>&nbsp;</p>
    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/communication/group/view', 'id'=>$group->id], ['class' => 'btn btn-primary']) ?>	
	<?= Html::submitButton(Yii::t('translation', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>


</div>
