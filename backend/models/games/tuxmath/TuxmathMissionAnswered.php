<?php

namespace backend\models\games\tuxmath;

use Yii;
use backend\models\User;

/**
 * This is the model class for table "tuxmath.mission_answered".
 *
 * @property integer $id
 * @property integer $quantityAnsweredQuestions
 * @property string $dataLocal
 * @property string $dateTimeLocalModification
 * @property integer $hitPercentage
 * @property string $mission
 * @property boolean $missionCompleted
 * @property integer $quantityOfQuestionsNotAnsweredCorrectly
 * @property integer $numberOfDistinctQuestionsNotAnsweredCorrectly
 * @property integer $quantityOfQuestions
 * @property double $summaryMedianTimeQuestion
 * @property integer $summaryQuestionsCorrect
 * @property integer $summaryQuestionsMissed
 * @property string $systemPlataform
 * @property string $systemArchitecture
 * @property string $systemOSRelease
 * @property string $systemHostname
 * @property string $systemLocalIp
 * @property integer $user_id
 *
 * @property User $user
 * @property TuxmathMissionQuestions $tuxmathMissionQuestions
 */
class TuxmathMissionAnswered extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tuxmath.mission_answered';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantityAnsweredQuestions', 'hitPercentage', 'quantityOfQuestionsNotAnsweredCorrectly', 'numberOfDistinctQuestionsNotAnsweredCorrectly', 'quantityOfQuestions', 'summaryQuestionsCorrect', 'summaryQuestionsMissed', 'user_id'], 'integer'],
            [['dataLocal', 'dateTimeLocalModification'], 'safe'],
            [['missionCompleted'], 'boolean'],
            [['summaryMedianTimeQuestion'], 'number'],
            [['mission', 'systemHostname'], 'string', 'max' => 100],
            [['systemPlataform', 'systemArchitecture', 'systemOSRelease', 'systemLocalIp'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'quantityAnsweredQuestions' => Yii::t('app', 'Quantity Answered Questions'),
            'dataLocal' => Yii::t('app', 'Data Local'),
            'dateTimeLocalModification' => Yii::t('app', 'Date Time Local Modification'),
            'hitPercentage' => Yii::t('app', 'Hit Percentage'),
            'mission' => Yii::t('app', 'Mission'),
            'missionCompleted' => Yii::t('app', 'Mission Completed'),
            'quantityOfQuestionsNotAnsweredCorrectly' => Yii::t('app', 'Quantity Of Questions Not Answered Correctly'),
            'numberOfDistinctQuestionsNotAnsweredCorrectly' => Yii::t('app', 'Number Of Distinct Questions Not Answered Correctly'),
            'quantityOfQuestions' => Yii::t('app', 'Quantity Of Questions'),
            'summaryMedianTimeQuestion' => Yii::t('app', 'Summary Median Time Question'),
            'summaryQuestionsCorrect' => Yii::t('app', 'Summary Questions Correct'),
            'summaryQuestionsMissed' => Yii::t('app', 'Summary Questions Missed'),
            'systemPlataform' => Yii::t('app', 'System Plataform'),
            'systemArchitecture' => Yii::t('app', 'System Architecture'),
            'systemOSRelease' => Yii::t('app', 'System Osrelease'),
            'systemHostname' => Yii::t('app', 'System Hostname'),
            'systemLocalIp' => Yii::t('app', 'System Local Ip'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTuxmathMissionQuestions()
    {
        return $this->hasOne(TuxmathMissionQuestions::className(), ['id' => 'id']);
    }
}
