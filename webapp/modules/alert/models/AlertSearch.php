<?php

namespace webapp\modules\alert\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webapp\modules\alert\models\Alert;

/**
 * AlertSearch represents the model behind the search form about `webapp\modules\alert\models\Alert`.
 */
class AlertSearch extends Alert {

    const SITUATION_AVAILABLES = 'availables';
    const SITUATION_ALL = 'all';

    public $situation; //availables or all

    /**
     * @inheritdoc
     */

    public function init() {
	parent::init();
	$this->situation = self::SITUATION_AVAILABLES;
    }

    public function rules() {
	return [
		[['event_id', 'risk_id', 'alert_status_id'], 'integer'],
		[['situation', 'start', 'end'], 'safe'],
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'event_id' => Yii::t('translation', 'alert.event_id'),
	    'risk_id' => Yii::t('translation', 'alert.risk_id'),
	    'start' => Yii::t('translation', 'alert.start'),
	    'end' => Yii::t('translation', 'alert.end'),
	    'alert_status_id' => Yii::t('translation', 'alert.alert_status_id'),
	    'situation' => Yii::t('translation', 'alert.alertserch_situation'),
	   ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
	// bypass scenarios() implementation in the parent class
	return Model::scenarios();
    }

    public function emptyDataProvider() {
	$query = Alert::find()->orderBy('sent desc');
	$dataProvider = new ActiveDataProvider([
	    'query' => $query
	]);
	return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
	$query = Alert::find()->orderBy('id desc');

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

	if ($this->situation == self::SITUATION_AVAILABLES) {
	    /* $query->orWhere([
	      'encerrado' => null
	      ]);
	      $query->orWhere([
	      'encerrado' => false
	      ]); */

	    $query->andWhere([
		'>=',
		'end',
		date('Y-m-d H:i:s')
	    ]);
	}


	// grid filtering conditions
	$query->andFilterWhere([
	    'event_id' => $this->event_id,
	    'risk_id' => $this->risk_id,
	    'alert_status_id' => $this->alert_status_id
	]);

	if (!empty($this->start)) {
	    $format = 'Y-m-d';
	    $date = \DateTime::createFromFormat($format, $this->start);
	    // \Yii::$app->dumper->show($this->data_inicial, true);
	    // die($this->data_inicial);
	    $query->andWhere([
		'>=',
		'start',
		$date->format('Y-m-d 00:00:00')
	    ]);
	}
	if (!empty($this->end)) {
	    $format = 'Y-m-d';
	    $date = \DateTime::createFromFormat($format, $this->end);
	    $query->andWhere([
		'<=',
		'end',
		$date->format('Y-m-d 23:59:59')
	    ]);
	}


	return $dataProvider;
    }

}
