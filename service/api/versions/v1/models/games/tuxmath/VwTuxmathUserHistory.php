<?php

namespace api\versions\v1\models\games\tuxmath;

use Yii;
use yii\data\SqlDataProvider;
/**
 * This is the model class for table "tuxmath.mission".
 *
 */
class VwTuxmathUserHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tuxmath_vw_tuxmath_user_history';
    }

    public static function getProviderUserHistory($pageSize = 20)
    {

    	 $count = Yii::$app->db->createCommand('
            SELECT COUNT(*) FROM tuxmath_vw_tuxmath_user_history WHERE user_id=:user_id
        ', [':user_id' => Yii::$app->user->id])->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => 'SELECT id, data, mission, quantityAnsweredQuestions, hitpercentage, 
               missioncompleted, quantityOfQuestions, summaryQuestionsCorrect, 
               quantityOfQuestionsNotAnsweredCorrectly, summaryMedianTimeQuestion, 
               summaryQuestionsMissed FROM tuxmath_vw_tuxmath_user_history WHERE user_id=:user_id',
            'params' => [':user_id' => Yii::$app->user->id],
            'totalCount' => $count,
            'pagination' =>[
                'pageSize' => $pageSize,
            ],
        ]);

        return $provider; 
    }

}
