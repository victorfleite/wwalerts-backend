<?php

namespace api\versions\v1\models\common;

use Yii;

/**
 * This is the model class for table "user".
 *
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }



}
