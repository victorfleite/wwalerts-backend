<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Escola;

/**
 * EscolaSearch represents the model behind the search form about `app\models\Escola`.
 */
class EscolaSearch extends Escola
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nome', 'endereco', 'ddd1', 'telefone1', 'ddd2', 'telefone2', 'cidade', 'uf', 'cnpj', 'nome_responsavel', 'site', 'email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Escola::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'endereco', $this->endereco])
            ->andFilterWhere(['like', 'ddd1', $this->ddd1])
            ->andFilterWhere(['like', 'telefone1', $this->telefone1])
            ->andFilterWhere(['like', 'ddd2', $this->ddd2])
            ->andFilterWhere(['like', 'telefone2', $this->telefone2])
            ->andFilterWhere(['like', 'cidade', $this->cidade])
            ->andFilterWhere(['like', 'uf', $this->uf])
            ->andFilterWhere(['like', 'cnpj', $this->cnpj])
            ->andFilterWhere(['like', 'nome_responsavel', $this->nome_responsavel])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
