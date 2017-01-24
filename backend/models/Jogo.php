<?php

namespace app\models;

use Yii;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "jogo".
 *
 * @property integer $id
 * @property string $nome
 * @property string $descricao
 * @property string $habilidades
 * @property string $jogo
 *
 * @property JogoFase[] $jogoFases
 */
class Jogo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jogo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'descricao'], 'required'],
            [['descricao', 'habilidades'], 'string'],
            [['nome'], 'string', 'max' => 200],
            [['jogo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Jogo'),
            'descricao' => Yii::t('app', 'Descrição'),
            'habilidades' => Yii::t('app', 'Habilidades'),
            'jogo' => Yii::t('app', 'Jogo/App'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJogoFases()
    {
        return $this->hasMany(JogoFase::className(), ['jogo_id' => 'id']);
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        $this->descricao = HtmlPurifier::process($this->descricao);
        $this->habilidades = HtmlPurifier::process($this->habilidades);
        return true;
    }
    public function afterFind() {
        parent::afterFind();
        $this->descricao = HtmlPurifier::process($this->descricao);
        $this->habilidades = HtmlPurifier::process($this->habilidades);
        return true;
    }
}
