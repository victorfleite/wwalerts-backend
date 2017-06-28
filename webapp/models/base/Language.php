<?php

namespace webapp\models\base;

use Yii;

/**
 * This is the base model class for table "public.language".
 *
 * @property integer $id
 * @property string $code
 * @property integer $status
 */
class Language extends \yii\db\ActiveRecord
{
  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 5]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.language';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'code' => Yii::t('translation', 'Code'),
            'status' => Yii::t('translation', 'Status'),
        ];
    }
}
