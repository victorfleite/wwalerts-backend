<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\TriggerGroupFilter as BaseTriggerGroupFilter;
use \common\components\behaviors\PolygonBehavior;

/**
 * This is the model class for table "communication.trigger_group_filter".
 */
class TriggerGroupFilter extends BaseTriggerGroupFilter implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;
    
    public $wktErrorMessage;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['trigger_id', 'group_id', 'name', 'geom'], 'required'],
		[['trigger_id', 'group_id', 'status'], 'integer'],
		[['geom', 'description'], 'string'],
		[['geom'], \common\components\validators\WktValidator::className()],
		[['name'], 'string', 'max' => 150],
		[['trigger_id', 'group_id'], 'unique', 'targetAttribute' => ['trigger_id', 'group_id'], 'message' => \Yii::t('translation', 'triggergroupfilter.unique_key_trigger_group')]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'trigger_id' => Yii::t('translation', 'triggergroupfilter.trigger_id'),
	    'group_id' => Yii::t('translation', 'triggergroupfilter.group_id'),
	    'name' => Yii::t('translation', 'triggergroupfilter.name'),
	    'geom' => Yii::t('translation', 'triggergroupfilter.geom'),
	    'status' => Yii::t('translation', 'triggergroupfilter.status'),
	    'description' => Yii::t('translation', 'triggergroupfilter.description'),
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

}
