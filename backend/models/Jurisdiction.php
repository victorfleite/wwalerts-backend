<?php

namespace app\models;

use \app\models\base\Jurisdiction as BaseJurisdiction;

/**
 * This is the model class for table "operative.jurisdiction".
 */
class Jurisdiction extends BaseJurisdiction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['name', 'geom'], 'string'],
            [['institution_id'], 'integer'],
            [['color'], 'string', 'max' => 10]
        ]);
    }
	
}
