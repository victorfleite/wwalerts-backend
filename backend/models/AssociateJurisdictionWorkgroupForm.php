<?php

/**
 * Description of AssociateJurisdictionWorkgroupForm
 *
 * @author victor.leite
 */
class AssociateJurisdictionWorkgroupForm extends Model {

    public $jurisdictions;

    /**
     * @return array the validation rules.
     */
    public function rules() {
	return [
		['jurisdictions', 'safe']
	];
    }

}
