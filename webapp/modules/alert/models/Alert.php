<?php

namespace webapp\modules\alert\models;

use Yii;
use \webapp\modules\alert\models\base\Alert as BaseAlert;

/**
 * This is the model class for table "alert.alert".
 */
class Alert extends BaseAlert {

    public $map_base64;
    public $description;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['event_id', 'risk_id', 'geom', 'start', 'end', 'alert_status_id'], 'required'],
		[['geom'], \common\components\validators\UserJurisdictionValidator::className()],
		[['event_id', 'risk_id', 'alert_status_id', 'cap_id', 'created_by', 'updated_by'], 'integer'],
		[['geom', 'hash', 'map_base64', 'description'], 'string'],
		[['created_at', 'start', 'end', 'updated_at'], 'safe'],
		[['map_file'], 'string', 'max' => 300]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'alert.id'),
	    'event_id' => Yii::t('translation', 'alert.event_id'),
	    'risk_id' => Yii::t('translation', 'alert.risk_id'),
	    'geom' => Yii::t('translation', 'alert.geom'),
	    'start' => Yii::t('translation', 'alert.start'),
	    'end' => Yii::t('translation', 'alert.end'),
	    'alert_status_id' => Yii::t('translation', 'alert.alert_status_id'),
	    'map_file' => Yii::t('translation', 'alert.map_file'),
	    'hash' => Yii::t('translation', 'alert.hash'),
	    'cap_id' => Yii::t('translation', 'alert.cap_id'),
	    'created_at' => Yii::t('translation', 'alert.created_at'),
	    'updated_at' => Yii::t('translation', 'alert.updated_at'),
	    'created_by' => Yii::t('translation', 'alert.created_by'),
	    'updated_by' => Yii::t('translation', 'alert.updated_by'),
	];
    }

}
