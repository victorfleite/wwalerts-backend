<?php

namespace backend\models;

use Yii;
use \app\models\base\Batch as BaseBatch;

/**
 * This is the model class for table "local.batch".
 */
class Batch extends BaseBatch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['type', 'file_path', 'user_id'], 'required'],
            [['type', 'user_id'], 'integer'],
            [['create_at', 'date_initial_import', 'date_final_import'], 'safe'],
            [['file_path'], 'string', 'max' => 255],
            [['comment'], 'string', 'max' => 500]
        ]);
    }
	
}
