<?php

namespace backend\models\games\tuxmath;

use Yii;

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
        return 'tuxmath.mission_questions_not_answered_correctly';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mission_id'], 'integer'],
            [['question'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mission_id' => Yii::t('app', 'Mission ID'),
            'question' => Yii::t('app', 'Question'),
        ];
    }
}
