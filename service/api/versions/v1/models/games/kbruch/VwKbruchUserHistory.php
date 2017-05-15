<?php

namespace api\versions\v1\models\games\kbruch;

use Yii;
use yii\data\SqlDataProvider; 
/**
 * This is the model class for table "tuxmath.mission".
 *
 */
class VwKbruchUserHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kbrunch_vw_kbruch_user_history';
    }

    public static function getProviderUserHistory($pageSize = 20)
    {

    	 $count = Yii::$app->db->createCommand('
            SELECT COUNT(*) FROM kbrunch_vw_kbruch_user_history WHERE user_id=:user_id
        ', [':user_id' => Yii::$app->user->id])->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => 'SELECT correct,count,skipped,data FROM kbrunch_vw_kbruch_user_history WHERE user_id=:user_id',
            'params' => [':user_id' => Yii::$app->user->id],
            'totalCount' => $count,  
            'pagination' =>[
                'pageSize' => $pageSize,
            ],
        ]);

        return $provider; 
    }

}
