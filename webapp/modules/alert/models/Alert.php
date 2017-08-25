<?php

namespace webapp\modules\alert\models;

use Yii;
use \webapp\modules\alert\models\base\Alert as BaseAlert;
use \common\components\behaviors\PolygonBehavior;
use \common\components\behaviors\TimestampBehavior;
use yii\behaviors\TimestampBehavior as MomentTimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "alert.alert".
 */
class Alert extends BaseAlert {

    const CANCELED_TRUE = true;
    const CANCELED_FALSE = false;

    public $map_base64;
    public $description;

    const MAP_PATH = 'images/alerts/maps/';

    public function init() {
	parent::init();
	$this->canceled = Alert::CANCELED_FALSE;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['event_id', 'risk_id', 'start', 'end', 'alert_status_id'], 'required'],
		[['geom'], 'required', 'message' => Yii::t('translation', 'alert.message_error_geometry_empty')],
		[['start', 'end'], 'date', 'format' => 'yyyy-mm-dd HH:mm'],
		[['start'], 'checkDates'],
		[['geom'], \common\components\validators\UserJurisdictionValidator::className()],
		[['event_id', 'risk_id', 'alert_status_id', 'cap_id', 'created_by', 'updated_by'], 'integer'],
		[['geom', 'hash', 'map_base64', 'description'], 'string'],
		[['created_at', 'start', 'end', 'updated_at', 'canceled'], 'safe'],
		[['map_file'], 'string', 'max' => 300]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'alert.id'),
	    'event_id' => Yii::t('translation', 'alert.event_id'),
	    'risk_id' => Yii::t('translation', 'alert.risk_id'),
	    'geom' => Yii::t('translation', 'alert.geom'),
	    'start' => Yii::t('translation', 'alert.start'),
	    'end' => Yii::t('translation', 'alert.end'),
	    'alert_status_id' => Yii::t('translation', 'alert.alert_status_id'),
	    'map_file' => Yii::t('translation', 'alert.map_file'),
	    'hash' => Yii::t('translation', 'alert.hash'),
	    'cap_id' => Yii::t('translation', 'alert.cap_id'),
	    'created_at' => Yii::t('translation', 'alert.created_at'),
	    'updated_at' => Yii::t('translation', 'alert.updated_at'),
	    'created_by' => Yii::t('translation', 'alert.created_by'),
	    'updated_by' => Yii::t('translation', 'alert.updated_by'),
	    'canceled' => Yii::t('translation', 'alert.canceled'),
	];
    }

    public function checkDates() {

	$start = \DateTime::createFromFormat('Y-m-d H:i', $this->start);
	$end = \DateTime::createFromFormat('Y-m-d H:i', $this->end);

	if ($start->getTimestamp() > $end->getTimestamp()) {
	    $this->addError('start', \Yii::t('translation', 'alert.message_error_start_date_grater_then_end_date', [
			'start' => $this->getAttributeLabel('start'),
			'end' => $this->getAttributeLabel('end')
	    ]));
	    return false;
	}
	return true;
    }

    /**
     * Save alert base64 image data to image file (image/jpg)
     */
    public function saveMapBase64() {

	$img = $this->map_base64;
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = Alert::MAP_PATH . uniqid() . '.png';
	$success = file_put_contents($file, $data);
	$this->map_file = $file;
	$this->save(false, ['map_file']);
	//TODO save thumb image
    }

    /**
     * Cancel the alert event
     */
    public function cancel() {

	$this->canceled = Alert::CANCELED_TRUE;
	$this->save(false, ['canceled']);
	
    }

    public function behaviors() {
	return [
	    'saveDate' => [
		'class' => TimestampBehavior::className(),
		'fields' => [
		    'start',
		    'end'
		],
		'datetimeFormat' => 'Y-m-d H:i',
		'dateFormat' => 'Y-m-d',
		'dateTimeFormatDataBase' => 'Y-m-d H:i:s',
		'dateFormatDataBase' => 'Y-m-d'
	    ],
	    'timestamp' => [
		'class' => MomentTimestampBehavior::className(),
		'createdAtAttribute' => 'created_at',
		'updatedAtAttribute' => 'updated_at',
		'value' => new \yii\db\Expression('NOW()'),
	    ],
	    'blameable' => [
		'class' => BlameableBehavior::className(),
		'createdByAttribute' => 'created_by',
		'updatedByAttribute' => 'updated_by',
		'value' => \Yii::$app->user->id,
	    ],
	    'geometry' => [
		'class' => PolygonBehavior::className(),
		'attribute' => 'geom',
		'type' => PolygonBehavior::GEOMETRY_POLYGON,
		'pk_name' => 'id',
	    ]
	];
    }

}
