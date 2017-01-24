<?php

namespace app\models; 

use Yii;

/**
 * This is the model class for table "escola".
 *
 * @property integer $id
 * @property string $nome
 * @property string $endereco
 * @property string $ddd1
 * @property string $telefone1
 * @property string $ddd2
 * @property string $telefone2
 * @property string $cidade
 * @property string $uf
 * @property string $cnpj
 * @property string $nome_responsavel
 * @property string $site
 * @property string $email
 *
 * @property RlEscolaProfessor[] $rlEscolaProfessors
 * @property Professor[] $idProfessors
 * @property RlEscolaResponsavel[] $rlEscolaResponsavels
 * @property User[] $idUsers
 * @property RlTurmaProfessorEscola[] $rlTurmaProfessorEscolas
 * @property Turma[] $turmas
 */
class Escola extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'escola';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'endereco', 'ddd1', 'telefone1', 'cidade', 'uf', 'cnpj', 'nome_responsavel'], 'required'],
            [['nome', 'endereco', 'nome_responsavel'], 'string', 'max' => 255],
            [['ddd1', 'ddd2'], 'string', 'max' => 3],
            [['telefone1', 'telefone2'], 'string', 'max' => 9],
            [['cidade', 'email'], 'string', 'max' => 100],
            [['uf'], 'string', 'max' => 2],
            [['cnpj'], 'string', 'max' => 14],
            [['site'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome da Escola'),
            'endereco' => Yii::t('app', 'Endereço da Escola'),
            'ddd1' => Yii::t('app', 'DDD'),
            'telefone1' => Yii::t('app', 'Telefone Comercial'),
            'ddd2' => Yii::t('app', 'DDD'),
            'telefone2' => Yii::t('app', 'Telefone Fax'),
            'cidade' => Yii::t('app', 'Cidade'),
            'uf' => Yii::t('app', 'UF'),
            'cnpj' => Yii::t('app', 'CNPJ da Escola'),
            'nome_responsavel' => Yii::t('app', 'Responsável'),
            'site' => Yii::t('app', 'Site'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlEscolaProfessors()
    {
        return $this->hasMany(RlEscolaProfessor::className(), ['id_escola' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProfessors()
    {
        return $this->hasMany(Professor::className(), ['id' => 'id_professor'])->viaTable('rl_escola_professor', ['id_escola' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlEscolaResponsavels()
    {
        return $this->hasMany(RlEscolaResponsavel::className(), ['id_escola' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'id_user'])->viaTable('rl_escola_responsavel', ['id_escola' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlTurmaProfessorEscolas()
    {
        return $this->hasMany(RlTurmaProfessorEscola::className(), ['id_escola' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['id_escola' => 'id']);
    }
}
