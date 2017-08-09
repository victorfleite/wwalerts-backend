<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use webapp\modules\operative\models\Workgroup;
use softark\duallistbox\DualListbox;

/* @var $this yii\web\View */
/* @var $model backend\models\Workworkgroup */
$this->title = Yii::t('translation', 'trigger.associate_workgroup_title');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'triggers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $trigger->name, 'url' => ['view', 'id' => $trigger->id]];
$this->params['breadcrumbs'][] = $this->title
?>
<div class="grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class='text-right'>
	<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $trigger->id], ['class' => 'btn btn-primary']) ?>
    </p>



    <?=
    DetailView::widget(['model' => $trigger, 'attributes' => [
	    'name',
		[
		'attribute' => 'type',
		'value' => function($data) {
		    return webapp\modules\communication\models\Trigger::getTypeLabel($data->type);
		}
	    ],
		[
		'attribute' => 'behavior_id',
		'value' => function($data) {
		    return $data->behaviorTrigger->name;
		},
	    ],
		[
		'attribute' => 'event_id',
		'value' => function($data) {
		    if (empty($data->event_id)) {
			return \Yii::t('translation', 'trigger.all_events');
		    }
		    return Yii::t('translation', $data->event->name_i18n);
		},
	    ],
		[
		'attribute' => 'risk_id',
		'value' => function($data) {
		    if (empty($data->risk_id)) {
			return \Yii::t('translation', 'trigger.all_risks');
		    }
		    return Yii::t('translation', $data->risk->name_i18n);
		},
	    ],
    ]]);
    $form = ActiveForm::begin();
    ?>
    <div>

<?php
$options = [
    'multiple' => true,
    'size' => 20,
];
$workgroupsAvailable = Workgroup::find()->orderBy('name')->asArray()->all();
$items = ArrayHelper::map($workgroupsAvailable, 'id', 'name');
// echo $form->field($model, $attribute)->listBox($items, $options);
echo $form->field($model, 'workgroups')->widget(DualListbox::className(), [
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
    <div class="form-workgroup">
<?= Html::a(Yii::t('translation', 'Cancel'), ['/communication/trigger/index'], ['class' => 'btn btn-primary']) ?>	
	<?= Html::submitButton(Yii::t('translation', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>


</div>
