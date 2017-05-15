<?php

namespace api\versions\v1\models\games\tuxmath;

use api\versions\v1\components\behaviors\Hashtags;
use api\versions\v1\models\common\Hashtag;
/**
 * This is the model class for table "tuxmath.mission_answered".
 * @property TuxmathMissionQuestions $tuxmathMissionQuestions
 */
class TuxmathMissionAnswered extends \yii\db\ActiveRecord {

    public $hashtags = [];
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tuxmath_mission_answered';
    }
    
    public function behaviors() {
        return [
            [
                'class' => Hashtags::className(),
            ],
        ];
    }
    public function getHashtags()
    {
        return $this->hasMany(Hashtag::className(), ['id' => 'tag_id'])->viaTable('rl_tag_tuxmath_mission_answered', ['tuxmath_mission_answered_id' => 'id']);
    }

  
}
