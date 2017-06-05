<?php

namespace app\models;

use \app\models\base\Workgroup as BaseWorkgroup;

/**
 * This is the model class for table "operative.workgroup".
 */
class Workgroup extends BaseWorkgroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 500]
        ]);
    }
	
}
