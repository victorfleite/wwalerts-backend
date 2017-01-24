<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rl_turma_professor_escola".
 *
 * @property integer $id_turma
 * @property integer $id_professor
 * @property integer $id_escola
 *
 * @property Escola $idEscola
 * @property Professor $idProfessor
 * @property Turma $idTurma
 */
class RlTurmaProfessorEscola extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rl_turma_professor_escola';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_turma', 'id_professor', 'id_escola'], 'required'],
            [['id_turma', 'id_professor', 'id_escola'], 'integer'],
            [['id_escola'], 'exist', 'skipOnError' => true, 'targetClass' => Escola::className(), 'targetAttribute' => ['id_escola' => 'id']],
            [['id_professor'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['id_professor' => 'id']],
            [['id_turma'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['id_turma' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_turma' => Yii::t('app', 'Turma'),
            'id_professor' => Yii::t('app', 'Professor'),
            'id_escola' => Yii::t('app', 'Escola'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTurma()
    {
        return $this->hasOne(Turma::className(), ['id' => 'id_turma']);
    }
}
