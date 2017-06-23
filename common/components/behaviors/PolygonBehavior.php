<?php

namespace common\components\behaviors;

use Yii;
use nanson\postgis\behaviors\GeometryBehavior;


class PolygonBehavior extends GeometryBehavior {

    public $pk_name = 'id';
    public $skipAfterFindPostgis = true;
    public $st_srid_out = '4326';
    public $st_srid_in = '3857';

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init() {
	parent::init();
    }

    /**
     * Convert array to GeoJson expression before save
     * @return bool
     */
    public function beforeSave() {
	parent::beforeSave();
	
	return true;
    }

    /**
     * Convert attribute to array after save
     * @return bool
     */
    public function afterSave() {
	parent::afterSave();

	$attribute = $this->attribute;
	$pk = $this->pk_name;
	// Setar Projeção no banco
	if (!empty($this->owner->$attribute)) {
	    $q = "UPDATE " . $this->owner->tableName() . " SET $attribute = ST_Transform(ST_GeometryFromText('" . $this->owner->$attribute . "'," . $this->st_srid_in . "), " . $this->st_srid_out . ") WHERE " . $this->pk_name . " = " . $this->owner->$pk . ";";
	    //\yii::$app->dumper->show($q, true);
	    $res = Yii::$app->db->createCommand($q)->execute();
	    $this->owner->$attribute = $res [$attribute];
	}

	return true;
    }

    /**
     * Convert attribute to WKT after find
     * 
     * @return bool
     */
    public function afterFind() {
	parent::afterFind();

	if ($this->skipAfterFindPostgis) {
	    $this->geometryToWKT();
	}

	$attributeChanged = $this->owner->isAttributeChanged($this->attribute);
	if ($attributeChanged) {
	    $this->owner->setOldAttribute($this->attribute, $this->owner->{$this->attribute});
	}

	return true;
    }

    /**
     * Convert model attribute from Postgis binary (GEOMETRY) to WKT
     */
    protected function geometryToWKT() {
	$attribute = $this->attribute;

	if (!empty($this->owner->$attribute)) {
	    $q = "SELECT ST_AsText(ST_Transform(ST_Force2D('" . $this->owner->$attribute . "'::geometry), ".$this->st_srid_in.")) as $attribute";
	    $res = Yii::$app->db->createCommand($q)->queryOne();
	    $this->owner->$attribute = $res [$attribute];
	}
    }

}
