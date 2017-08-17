<?php

namespace webapp\modules\alert\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webapp\modules\alert\models\Alert;

/**
 * AlertSearch represents the model behind the search form about `webapp\modules\alert\models\Alert`.
 */
class AlertSearch extends Alert
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_id', 'risk_id', 'alert_status_id', 'cap_id', 'created_by', 'updated_by'], 'integer'],
            [['geom', 'created_at', 'start', 'end', 'map_file', 'hash', 'updated_at'], 'safe'],
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
        $query = Alert::find();

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
            'id' => $this->id,
            'event_id' => $this->event_id,
            'risk_id' => $this->risk_id,
            'created_at' => $this->created_at,
            'start' => $this->start,
            'end' => $this->end,
            'alert_status_id' => $this->alert_status_id,
            'cap_id' => $this->cap_id,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'geom', $this->geom])
            ->andFilterWhere(['like', 'map_file', $this->map_file])
            ->andFilterWhere(['like', 'hash', $this->hash]);

        return $dataProvider;
    }
}
