<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "turma".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $ano
 * @property integer $id_escola
 *
 * @property RlTurmaAluno[] $rlTurmaAlunos
 * @property User[] $idAlunos
 * @property RlTurmaProfessorEscola[] $rlTurmaProfessorEscolas
 * @property Escola $idEscola
 */
class Turma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'turma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'ano', 'id_escola'], 'required'],
            [['ano', 'id_escola'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['id_escola'], 'exist', 'skipOnError' => true, 'targetClass' => Escola::className(), 'targetAttribute' => ['id_escola' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'nome' => Yii::t('app', 'Nome da Turma'),
            'ano' => Yii::t('app', 'Ano da Turma'),
            'id_escola' => Yii::t('app', 'Escola'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlTurmaAlunos()
    {
        return $this->hasMany(RlTurmaAluno::className(), ['id_turma' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlunos()
    {
        return $this->hasMany(User::className(), ['id' => 'id_aluno'])->viaTable('rl_turma_aluno', ['id_turma' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlTurmaProfessorEscolas()
    {
        return $this->hasMany(RlTurmaProfessorEscola::className(), ['id_turma' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEscola()
    {
        return $this->hasOne(Escola::className(), ['id' => 'id_escola']);
    }
}
