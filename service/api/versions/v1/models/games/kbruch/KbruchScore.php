<?php

namespace api\versions\v1\models\games\kbruch;

use Yii;
use api\versions\v1\components\behaviors\Hashtags;
use api\versions\v1\models\common\Hashtag;

/**
 * This is the model class for table "tuxmath.mission".
 *
 */
class KbruchScore extends \yii\db\ActiveRecord {

    public $hashtags = [];

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'kbruch_score';
    }

    public function behaviors() {
        return [
            [
                'class' => Hashtags::className(),
            ],
        ];
    }

    public function getHashtags() {
        return $this->hasMany(Hashtag::className(), ['id' => 'tag_id'])->viaTable('rl_tag_kbruch_score', ['kbruch_score_id' => 'id']);
    }

}
