<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace api\versions\v1\models\common;

use Yii;

/**
 * This is the model class for table "hashtag".
 *
 * @property integer $id
 * @property string $name
 */
class Hashtag extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hashtag';
    }

}