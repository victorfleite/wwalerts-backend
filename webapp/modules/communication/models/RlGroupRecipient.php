<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\RlGroupRecipient as BaseRlGroupRecipient;

/**
 * This is the model class for table "communication.rl_group_recipient".
 */
class RlGroupRecipient extends BaseRlGroupRecipient {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['group_id', 'recipient_id'], 'required'],
		[['group_id', 'recipient_id'], 'integer']
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'group_id' => Yii::t('translation', 'rlgrouprecipient.group_id'),
	    'recipient_id' => Yii::t('translation', 'rlgrouprecipient.recipient_id'),
	];
    }

}
