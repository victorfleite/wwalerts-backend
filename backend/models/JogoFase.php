<?php

namespace app\models;

use Yii;
use backend\models\Tag;
use dosamigos\taggable\Taggable;

/**
 * This is the model class for table "jogo_fase".
 *
 * @property integer $id
 * @property integer $jogo_id
 * @property string $nome
 * @property string $descricao
 * @property integer $jogo_fase_categoria_id
 * @property string $objetivo_jogo
 * @property string $objetivo_pedagogico
 * @property string $regra_jogo
 * @property string $exemplo
 * @property string $habilidades
 * @property string $disciplina
 * @property string $indicacao
 * @property string $acesso
 *
 * @property Jogo $jogo
 * @property TuxmathMission[] $tuxmathMissions
 */
class JogoFase extends \yii\db\ActiveRecord
{
    public $mission; 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jogo_fase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                   [['jogo_id', 'nome', 'jogo_fase_categoria_id'], 'required'],
                   [['jogo_id', 'jogo_fase_categoria_id'], 'integer'],
                   [['descricao', 'objetivo_jogo', 'objetivo_pedagogico', 'regra_jogo', 'exemplo', 'habilidades', 'disciplina', 'indicacao', 'acesso'], 'string'],
            [['nome'], 'string', 'max' => 100],
            [['jogo_id', 'nome'], 'unique', 'targetAttribute' => ['jogo_id', 'nome'], 'message' => 'The combination of Jogo ID and Nome has already been taken.'],
            [['jogo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jogo::className(), 'targetAttribute' => ['jogo_id' => 'id']],
             [['tagNames'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jogo_id' => Yii::t('app', 'Jogo'),
            'nome' => Yii::t('app', 'Nome'),
            'mission' => 'Identificador da Missão (Campo \'mission\' em log.csv)',
            'descricao' => Yii::t('app', 'Descrição'),
            'habilidades' => Yii::t('app', 'Habilidades'),
            'jogo_fase_categoria_id' => Yii::t('app', 'Categoria'),
            'tagNames' => Yii::t('app', 'Tags'),


        ];
    }

    public function behaviors() {
        return [
            [
                'class' => Taggable::className(),
            ],
        ];
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('rl_jogo_fase_tag', ['jogo_fase_id' => 'id']);
    }
    public function getTagList(){
        $tags = $this->getTags()->all();
        $aux = [];
        if(!empty($tags)){
            foreach ($tags as $tag) {
                $aux[] = $tag->name;
            }            
        }
        return $aux;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJogo()
    {
        return $this->hasOne(Jogo::className(), ['id' => 'jogo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTuxmathMission()
    {
        return $this->hasOne(TuxmathMission::className(), ['jogo_fase_id' => 'id']);
    }
}
