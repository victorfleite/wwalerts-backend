<?php

namespace webapp\modules\local\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webapp\modules\local\models\Country;

/**
 * CountrySearch represents the model behind the search form about `app\models\Country`.
 */
class CountrySearch extends Country {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['gid', 'un', 'area', 'region', 'subregion', 'batch_id'], 'integer'],
		[['fips', 'iso2', 'iso3', 'name', 'geom'], 'safe'],
		[['pop2005', 'lon', 'lat'], 'number'],
	];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
	$query = Country::find()->select(['gid', 'un', 'name']);

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
	
	$query->andFilterWhere(['ilike', 'remove_accent(name)', \common\models\Util::removeAccent($this->name)])
		->andFilterWhere(['like', 'un', $this->un]);

	return $dataProvider;
    }

}
