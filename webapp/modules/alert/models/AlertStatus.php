<?php

namespace webapp\modules\alert\models;

use Yii;
use \webapp\modules\alert\models\base\AlertStatus as BaseAlertStatus;

/**
 * This is the model class for table "alert.status_alert".
 */
class AlertStatus extends BaseAlertStatus implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;
    use \common\components\traits\TranslationTrait;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name_i18n'], 'required'],
		[['hash'], 'string'],
		[['status'], 'integer'],
		[['name_i18n', 'description_i18n'], 'string', 'max' => 300],
		[['cap_status'], 'string', 'max' => 32]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'status_alert.id'),
	    'name_i18n' => Yii::t('translation', 'status_alert.name_i18n'),
	    'hash' => Yii::t('translation', 'status_alert.hash'),
	    'status' => Yii::t('translation', 'status_alert.status'),
	    'description_i18n' => Yii::t('translation', 'status_alert.description_i18n'),
	    'cap_status' => Yii::t('translation', 'status_alert.cap_status'),
	];
    }

}
