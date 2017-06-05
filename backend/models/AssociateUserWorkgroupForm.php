<?php

/**
 * Description of AssociateUserWorkgroupForm
 *
 * @author victor.leite
 */
class AssociateUserWorkgroupForm extends Model {

    public $users;

    /**
     * @return array the validation rules.
     */
    public function rules() {
	return [
		['users', 'safe']
	];
    }

}
