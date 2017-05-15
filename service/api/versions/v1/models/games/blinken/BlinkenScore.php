<?php

namespace api\versions\v1\models\games\blinken;

use Yii;
use api\versions\v1\components\behaviors\Hashtags;
use api\versions\v1\models\common\Hashtag;

/**
 * This is the model class for table "tuxmath.mission".
 *
 */
class BlinkenScore extends \yii\db\ActiveRecord {

    public $hashtags = [];

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'blinken_score';
    }

    public function behaviors() {
        return [
            [
                'class' => Hashtags::className(),
            ],
        ];
    }

    public function getHashtags() {
        return $this->hasMany(Hashtag::className(), ['id' => 'tag_id'])->viaTable('rl_tag_blinken_score', ['blinken_score_id' => 'id']);
    }

}
