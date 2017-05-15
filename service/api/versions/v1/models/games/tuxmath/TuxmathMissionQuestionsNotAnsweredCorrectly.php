<?php

namespace api\versions\v1\models\games\tuxmath;

/**
 * This is the model class for table "tuxmath.mission_questions_not_answered_correctly".
 *
 * @property integer $id
 * @property integer $mission_id
 * @property string $question
 */
class TuxmathMissionQuestionsNotAnsweredCorrectly extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tuxmath_mission_questions_not_answered_correctly';
    }
}
