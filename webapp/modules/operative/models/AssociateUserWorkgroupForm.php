<?php


namespace webapp\modules\operative\models;

use yii\base\Model;

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
    
    
       /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'users' => \Yii::t('translation', 'workgroup.associate_users_dualbox_title'),
	];
    }

}
