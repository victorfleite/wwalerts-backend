<?php

namespace backend\models\games\tuxmath;

use Yii;

/**
 * This is the model class for table "tuxmath.mission_questions".
 *
 * @property integer $id
 * @property integer $mission_id
 * @property string $question
 *
 * @property TuxmathMissionAnswered $id0
 */
class TuxmathMissionQuestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tuxmath.mission_questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mission_id'], 'integer'],
            [['question'], 'string', 'max' => 50],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => TuxmathMissionAnswered::className(), 'targetAttribute' => ['id' => 'id']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(TuxmathMissionAnswered::className(), ['id' => 'id']);
    }
}
