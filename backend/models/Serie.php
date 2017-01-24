<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "serie".
 *
 * @property integer $id
 * @property string $serie
 */
class Serie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'serie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serie'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serie' => 'Serie',
        ];
    }
}
