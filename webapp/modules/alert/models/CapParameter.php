<?php

namespace webapp\modules\alert\models;

use Yii;
use \webapp\modules\alert\models\base\CapParameter as BaseCapParameter;

/**
 * This is the model class for table "alert.cap_parameter".
 */
class CapParameter extends BaseCapParameter {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['cap_id', 'key'], 'required'],
		[['cap_id'], 'integer'],
		[['value'], 'string'],
		[['key'], 'string', 'max' => 50]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'cap_id' => Yii::t('translation', 'capparameter.cap_id'),
	    'key' => Yii::t('translation', 'capparameter.key'),
	    'value' => Yii::t('translation', 'capparameter.value'),
	];
    }

}
