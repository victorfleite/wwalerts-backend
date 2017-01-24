<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rl_escola_professor".
 *
 * @property integer $id_escola
 * @property integer $id_professor
 *
 * @property Escola $idEscola
 * @property Professor $idProfessor
 */
class RlEscolaProfessor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rl_escola_professor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_escola', 'id_professor'], 'required'],
            [['id_escola', 'id_professor'], 'integer'],
            [['id_escola'], 'exist', 'skipOnError' => true, 'targetClass' => Escola::className(), 'targetAttribute' => ['id_escola' => 'id']],
            [['id_professor'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['id_professor' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_escola' => Yii::t('app', 'Escola'),
            'id_professor' => Yii::t('app', 'Professor'),
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
    public function getIdProfessor()
    {
        return $this->hasOne(Professor::className(), ['id' => 'id_professor']);
    }
}
