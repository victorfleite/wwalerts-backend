<?php

namespace api\versions\v1\models\common;

use Yii;

/**
 * This is the model class for table "user".
 *
 */
class Config extends \yii\db\ActiveRecord {

    public $vars = [];

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'config';
    }
    public static function loadVars(){
        $config = new Config();
        return $config->setVars();
    }

    public function setVars() {
        $configs = self::find()->all();
        $r = [];
        foreach ($configs as $config) {
            $r[$config->varname] = $config->value;
        }
        $this->vars = $r;
        return $this;
    }

    public function getVar($name) {
        if (empty($this->vars)) {
            $this->setVars();
        }
        return $this->vars[$name];
    }

    public function getVars() {
        if (empty($this->vars)) {
            $this->setVars();
        }
        return $this->vars;
    }

}
