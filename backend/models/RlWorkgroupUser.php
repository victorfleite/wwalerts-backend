<?php

namespace app\models;

use \app\models\base\RlWorkgroupUser as BaseRlWorkgroupUser;

/**
 * This is the model class for table "operative.rl_workgroup_jurisdiction".
 */
class RlWorkgroupUser extends BaseRlWorkgroupUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['jurisdiction_id', 'workgroup_id'], 'required'],
            [['jurisdiction_id', 'workgroup_id'], 'integer']
        ]);
    }
	
}
