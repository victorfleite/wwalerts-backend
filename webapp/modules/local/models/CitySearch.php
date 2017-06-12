<?php

namespace webapp\modules\local\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webapp\modules\local\models\City;

/**
 * CitySearch represents the model behind the search form about `app\models\City`.
 */
class CitySearch extends City
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'batch_id'], 'integer'],
            [['latitude', 'longitude', 'state_id', 'geocode'], 'number'],
            [['name', 'the_geom_s', 'geom'], 'safe'],
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
        $query = City::find();

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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'state_id' => $this->state_id,
            'geocode' => $this->geocode,
            'batch_id' => $this->batch_id,
        ]);

        $query->andFilterWhere(['ilike', 'remove_accent(name)', \common\models\Util::removeAccent($this->name)])
            ->andFilterWhere(['like', 'the_geom_s', $this->the_geom_s])
            ->andFilterWhere(['like', 'geom', $this->geom]);

        return $dataProvider;
    }
}
