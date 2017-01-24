<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property RlJogoFaseTag[] $rlJogoFaseTags
 * @property JogoFase[] $jogoFases
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlJogoFaseTags()
    {
        return $this->hasMany(RlJogoFaseTag::className(), ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJogoFases()
    {
        return $this->hasMany(JogoFase::className(), ['id' => 'jogo_fase_id'])->viaTable('rl_jogo_fase_tag', ['tag_id' => 'id']);
    }
}
