<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rl_escola_responsavel".
 *
 * @property integer $id_escola
 * @property integer $id_user
 *
 * @property Escola $idEscola
 * @property User $idUser
 */
class RlEscolaResponsavel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rl_escola_responsavel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_escola', 'id_user'], 'required'],
            [['id_escola', 'id_user'], 'integer'],
            [['id_escola'], 'exist', 'skipOnError' => true, 'targetClass' => Escola::className(), 'targetAttribute' => ['id_escola' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_escola' => Yii::t('app', 'Escola'),
            'id_user' => Yii::t('app', 'Responsável'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEscola()
    {
        return $this->hasOne(Escola::className(), ['id' => 'id_escola']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
