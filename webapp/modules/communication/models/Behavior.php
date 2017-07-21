<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\Behavior as BaseBehavior;

/**
 * This is the model class for table "communication.behavior".
 */
class Behavior extends BaseBehavior {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name'], 'required'],
		[['params'], 'string'],
		[['name'], 'string', 'max' => 50],
		[['class'], 'string', 'max' => 300]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'behavior.id'),
	    'name' => Yii::t('translation', 'behavior.name'),
	    'class' => Yii::t('translation', 'behavior.class'),
	    'params' => Yii::t('translation', 'behavior.params'),
	];
    }

}
