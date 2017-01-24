<?php

namespace backend\models\games\tuxmath;

use Yii;
use backend\models\JogoFase;

/**
 * This is the model class for table "tuxmath.mission".
 *
 * @property string $mission
 * @property integer $jogo_fase_id
 *
 * @property JogoFase $jogoFase
 */
class TuxmathMission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tuxmath.mission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mission', 'jogo_fase_id'], 'required'],
            [['jogo_fase_id'], 'integer'],
            [['mission'], 'string', 'max' => 20],
            [['mission'], 'unique'],
         ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mission' => Yii::t('app', 'Mission'),
            'jogo_fase_id' => Yii::t('app', 'Jogo Fase ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJogoFase()
    {
        return $this->hasOne(JogoFase::className(), ['id' => 'jogo_fase_id']);
    }
}
