<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jogo_fase_categoria".
 *
 * @property integer $id
 * @property string $categoria
 */
class JogoFaseCategoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jogo_fase_categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['categoria'], 'string', 'max' => 300],
            [['categoria'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'categoria' => Yii::t('app', 'Categoria'),
        ];
    }
}
