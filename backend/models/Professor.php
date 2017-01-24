<?php

namespace app\models;

use Yii;
use backend\models\User;

/**
 * This is the model class for table "professor".
 *
 * @property string $cpf
 * @property integer $id
 *
 * @property User $id0
 * @property RlEscolaProfessor[] $rlEscolaProfessors
 * @property Escola[] $idEscolas
 * @property RlTurmaProfessorEscola[] $rlTurmaProfessorEscolas
 */
class Professor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'professor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpf', 'id'], 'required'],
            [['id'], 'integer'],
            [['cpf'], 'string', 'max' => 11],
            [['biografia'], 'string', 'max' => 800],
            [['cpf'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpf' => Yii::t('app', 'CPF do Professor'),
            'id' => Yii::t('app', 'Usuário'),
            'biografia' => Yii::t('app', 'Biografia'),
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlEscolaProfessors()
    {
        return $this->hasMany(RlEscolaProfessor::className(), ['id_professor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEscolas()
    {
        return $this->hasMany(Escola::className(), ['id' => 'id_escola'])->viaTable('rl_escola_professor', ['id_professor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlTurmaProfessorEscolas()
    {
        return $this->hasMany(RlTurmaProfessorEscola::className(), ['id_professor' => 'id']);
    }
}
