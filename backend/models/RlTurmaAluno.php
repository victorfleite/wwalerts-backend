<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rl_turma_aluno".
 *
 * @property integer $id_turma
 * @property integer $id_aluno
 *
 * @property Turma $idTurma
 * @property User $idAluno
 */
class RlTurmaAluno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rl_turma_aluno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_turma', 'id_aluno'], 'required'],
            [['id_turma', 'id_aluno'], 'integer'],
            [['id_turma'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['id_turma' => 'id']],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_aluno' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_turma' => Yii::t('app', 'Turma'),
            'id_aluno' => Yii::t('app', 'Aluno'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTurma()
    {
        return $this->hasOne(Turma::className(), ['id' => 'id_turma']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAluno()
    {
        return $this->hasOne(User::className(), ['id' => 'id_aluno']);
    }
}
