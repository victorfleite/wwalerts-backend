<?php

namespace webapp\modules\local\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webapp\modules\local\models\State;

/**
 * StateSearch represents the model behind the search form about `app\models\State`.
 */
class StateSearch extends State
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'country_id', 'batch_id'], 'integer'],
            [['name', 'abbreviati', 'icon_path', 'geom'], 'safe'],
            [['center_lat', 'center_lon', 'cd_geocodu'], 'number'],
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
        $query = State::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'gid' => $this->gid,
            'country_id' => $this->country_id,
            'center_lat' => $this->center_lat,
            'center_lon' => $this->center_lon,
            'cd_geocodu' => $this->cd_geocodu,
            'batch_id' => $this->batch_id,
        ]);

        $query->andFilterWhere(['ilike', 'remove_accent(name)', \common\models\Util::removeAccent($this->name)])
            ->andFilterWhere(['like', 'abbreviati', $this->abbreviati])
            ->andFilterWhere(['like', 'icon_path', $this->icon_path])
            ->andFilterWhere(['like', 'geom', $this->geom]);

        return $dataProvider;
    }
}
