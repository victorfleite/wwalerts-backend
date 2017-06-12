<?php

namespace webapp\modules\local\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use \webapp\modules\local\models\Region;

/**
 * RegionSearch represents the model behind the search form about `app\models\Region`.
 */
class RegionSearch extends Region
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'country_id', 'batch_id'], 'integer'],
            [['nm_meso', 'cd_geocodu', 'geom'], 'safe'],
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
        $query = Region::find();

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
            'batch_id' => $this->batch_id,
        ]);

        $query->andFilterWhere(['like', 'nm_meso', $this->nm_meso])
            ->andFilterWhere(['like', 'cd_geocodu', $this->cd_geocodu])
            ->andFilterWhere(['like', 'geom', $this->geom]);

        return $dataProvider;
    }
}
