<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\TriggerWorkgroupFilter as BaseTriggerWorkgroupFilter;
use \common\components\behaviors\PolygonBehavior;

/**
 * This is the model class for table "communication.trigger_workgroup_filter".
 */
class TriggerWorkgroupFilter extends BaseTriggerWorkgroupFilter implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['trigger_id', 'workgroup_id', 'name', 'geom'], 'required'],
		[['trigger_id', 'workgroup_id', 'status'], 'integer'],
		[['geom', 'description'], 'string'],
		[['geom'], \common\components\validators\WktValidator::className()],
		[['name'], 'string', 'max' => 150],
		[['trigger_id', 'workgroup_id'], 'unique', 'targetAttribute' => ['trigger_id', 'workgroup_id'], 'message' => 'The combination of Trigger ID and Workgroup ID has already been taken.']
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'triggerworkgroupfilter.id'),
	    'trigger_id' => Yii::t('translation', 'triggerworkgroupfilter.trigger_id'),
	    'workgroup_id' => Yii::t('translation', 'triggerworkgroupfilter.workgroup_id'),
	    'name' => Yii::t('translation', 'triggerworkgroupfilter.name'),
	    'geom' => Yii::t('translation', 'triggerworkgroupfilter.geom'),
	    'status' => Yii::t('translation', 'triggerworkgroupfilter.status'),
	    'description' => Yii::t('translation', 'triggerworkgroupfilter.description'),
	];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors() {
	return array_merge(parent::behaviors(), [
	    'geometry' => [
		'class' => PolygonBehavior::className(),
		'attribute' => 'geom',
		'type' => PolygonBehavior::GEOMETRY_POLYGON,
	    ]
	]);
    }

    /**
     * Save RlTriggerWorkgroup if not exists
     * @param type $insert
     * @param type $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) {
	parent::afterSave($insert, $changedAttributes);

	if ($insert == true) {

	    $exists = RlTriggerWorkgroup::find(['trigger_id' => $this->trigger_id, 'workgroup_id' => $this->workgroup_id])->exists();
	    if (!$exists) {
		$rl = new RlTriggerWorkgroup();
		$rl->trigger_id = $this->trigger_id;
		$rl->workgroup_id = $this->workgroup_id;
		$rl->save();
	    }
	}
    }

}
