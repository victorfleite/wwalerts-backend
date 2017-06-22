<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace webapp\modules\local\models;

/**
 * Description of Geometry
 *
 * @author victor.leite
 */
class Geometry {

    const LOCAL_COUNTRY = 'country';
    const LOCAL_STATE = 'state';
    const LOCAL_REGION = 'region';
    const LOCAL_CITY = 'city';

    public $st_srid_in = '4326';
    public $st_srid_out = '3857';
    public $locals;

    public function setLocalsArray($key, $arr) {
	$arr = (is_array($arr))?$arr:[];
	$this->locals[$key] = $arr;
    }

    public function getLocalsArray($key) {
	return $this->locals[$key];
    }

    public function prepareParameter($arr, $type) {
	switch ($type) {
	    case 'integer[]':
		return "'{" . implode(',', $arr) . "}'::" . $type;
		break;
	    default:
		break;
	}	
    }

    public function getPreparedParameter($key, $type) {
	return $this->prepareParameter($this->locals[$key], $type);
    }

    public function getGeometryFromLocals() {
	$q = "SELECT ST_AsText(ST_Transform(local.merge_locals_geometry(" . $this->getPreparedParameter(Geometry::LOCAL_COUNTRY,'integer[]') . ", " . $this->getPreparedParameter(Geometry::LOCAL_STATE,'integer[]') . ", " . $this->getPreparedParameter(Geometry::LOCAL_REGION,'integer[]') . ", " . $this->getPreparedParameter(Geometry::LOCAL_CITY,'integer[]') . "), " . $this->st_srid_out . ")) as wkt";
	//die($q);
	$res = \Yii::$app->db->createCommand($q)->queryOne();
	return $res["wkt"];
    }

    //
}
