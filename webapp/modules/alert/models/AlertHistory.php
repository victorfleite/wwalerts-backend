<?php

namespace webapp\modules\alert\models;

use Yii;
use \webapp\modules\alert\models\base\AlertHistory as BaseAlertHistory;

/**
 * This is the model class for table "alert.alert_history".
 */
class AlertHistory extends BaseAlertHistory {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['created_at', 'user_id', 'alert_id'], 'required'],
		[['created_at'], 'safe'],
		[['description_i18n', 'params'], 'string'],
		[['user_id', 'alert_id'], 'integer']
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'alerthistory.id'),
	    'description_i18n' => Yii::t('translation', 'alerthistory.description_I18n'),
	    'user_id' => Yii::t('translation', 'alerthistory.user_id'),
	    'alert_id' => Yii::t('translation', 'alerthistory.alert_id'),
	    'params' => Yii::t('translation', 'alerthistory.params'),
	];
    }

}
