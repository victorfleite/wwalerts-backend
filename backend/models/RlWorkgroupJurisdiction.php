<?php

namespace app\models;

use \app\models\base\RlWorkgroupJurisdiction as BaseRlWorkgroupJurisdiction;

/**
 * This is the model class for table "operative.rl_workgroup_jurisdiction".
 */
class RlWorkgroupJurisdiction extends BaseRlWorkgroupJurisdiction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['jurisdiction_id', 'workgroup_id'], 'required'],
            [['jurisdiction_id', 'workgroup_id'], 'integer'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
