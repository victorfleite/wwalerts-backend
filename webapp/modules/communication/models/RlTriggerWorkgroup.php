<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\RlTriggerWorkgroup as BaseRlTriggerWorkgroup;

/**
 * This is the model class for table "communication.rl_trigger_workgroup".
 */
class RlTriggerWorkgroup extends BaseRlTriggerWorkgroup {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['trigger_id', 'workgroup_id'], 'required'],
		[['trigger_id', 'workgroup_id'], 'integer']
	];
    }

}
