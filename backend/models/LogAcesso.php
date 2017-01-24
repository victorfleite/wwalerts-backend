<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log_acesso".
 *
 * @property integer $id
 * @property string $data
 * @property string $atividade
 * @property integer $id_user
 */
class LogAcesso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_acesso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'safe'],
            [['atividade', 'id_user'], 'required'],
            [['id_user'], 'integer'],
            [['atividade'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'data' => Yii::t('app', 'Data'),
            'atividade' => Yii::t('app', 'Atividade'),
            'id_user' => Yii::t('app', 'Id User'),
        ];
    }
}
