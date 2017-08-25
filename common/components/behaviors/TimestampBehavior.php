<?php

namespace common\components\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\db\pgsql\Schema;

class TimestampBehavior extends Behavior {

    public $fields = [];
    public $dateFormat = null;
    public $datetimeFormat = null;
    public $dateFormatDataBase = 'Y-m-d';
    public $dateTimeFormatDataBase = 'Y-m-d H:i:s';

    public function events() {
	return [
	    ActiveRecord::EVENT_BEFORE_INSERT => 'convertData',
	    ActiveRecord::EVENT_BEFORE_UPDATE => 'convertData',
	    ActiveRecord::EVENT_AFTER_FIND => 'showData'
	];
    }

    public function convertData($event) {

	$dateFormat = ($this->dateFormat) ? $this->dateFormat : \Yii::$app->formatter->dateFormat;
	$datetimeFormat = ($this->datetimeFormat) ? $this->datetimeFormat : \Yii::$app->formatter->datetimeFormat;

	if (is_array($this->fields) && count($this->fields) > 0) {
	    $model = $event->sender;
	    $tableSchema = $model->getTableSchema();
	    foreach ($this->fields as $field) {
		$value = $model->$field;
		$column = $tableSchema->getColumn($field);
		if ($column->dbType == Schema::TYPE_TIMESTAMP || $column->dbType == Schema::TYPE_DATETIME) {
		    $date = \DateTime::createFromFormat($datetimeFormat, $value);
		    $model->$field = $date->format($this->dateTimeFormatDataBase);
		}
		if ($column->dbType == Schema::TYPE_DATE) {
		    $date = \DateTime::createFromFormat($dateFormat, $model->$field);
		    $model->$field = $date->format($this->dateFormatDataBase);
		}
		/* $attributeChanged = $model->isAttributeChanged($field);
		  if ($attributeChanged) {
		  $model->setOldAttribute($field, $model->$field);
		  } */
	    }
	}
    }

    public function showData($event) {

	$dateFormat = ($this->dateFormat) ? $this->dateFormat : \Yii::$app->formatter->dateFormat;
	$datetimeFormat = ($this->datetimeFormat) ? $this->datetimeFormat : \Yii::$app->formatter->datetimeFormat;

	if (is_array($this->fields) && count($this->fields) > 0) {
	    $model = $event->sender;
	    $tableSchema = $model->getTableSchema();
	    foreach ($this->fields as $field) {
		$value = $model->$field;
		$column = $tableSchema->getColumn($field);
		if (($column->dbType == Schema::TYPE_TIMESTAMP || $column->dbType == Schema::TYPE_DATETIME) && !empty($value)) {
		    $date = \DateTime::createFromFormat($this->dateTimeFormatDataBase, $value);
		    //\Yii::$app->dumper->show($this->dateTimeFormatDataBase, true);
		    //\Yii::$app->dumper->show($date, true);
		    $model->$field = $date->format($this->datetimeFormat);
		}
		if (($column->dbType == Schema::TYPE_DATE) && !empty($value)) {
		    $date = \DateTime::createFromFormat($this->dateFormatDataBase, $model->$field);
		    //\Yii::$app->dumper->show($date, true);
		    $model->$field = $date->format($this->dateFormat);
		}
		/* $attributeChanged = $model->isAttributeChanged($field);
		  if ($attributeChanged) {
		  $model->setOldAttribute($field, $model->$field);
		  } */
	    }
	}
    }

}
