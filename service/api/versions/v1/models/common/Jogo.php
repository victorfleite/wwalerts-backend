<?php

namespace api\versions\v1\models\common;

use Yii;

/**
 * This is the model class for table "user".
 *
 */
class Jogo extends \yii\db\ActiveRecord
{
    const JOGO_TUXMATH = 'tuxmath';
    const JOGO_BLINKEN = 'blinken';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jogo';
    }

}

