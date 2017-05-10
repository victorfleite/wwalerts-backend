<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
	return [
	    TimestampBehavior::className(),
	];
    }

    public function attributeLabels() {
	return [
	    'name' => Yii::t('translation', 'user.name'),
	    'username' => Yii::t('translation', 'user.username'),
	    'email' => Yii::t('translation', 'user.email'),
	    'password' => Yii::t('translation', 'user.password'),
	    'status' => Yii::t('translation', 'user.status'),
	    'create_at' => Yii::t('translation', 'user.create_at'),
	];
    }

    public static function getStatusLabel($status) {
	switch ($status) {
	    case User::STATUS_ACTIVE:
		return Yii::t('translation', 'user.status_active');
		break;
	    case User::STATUS_DELETED:
		return Yii::t('translation', 'user.status_inactive');
		break;
	    default:
		break;
	}
    }

    public static function getStatusCombo() {
	return [
	    User::STATUS_ACTIVE => Yii::t('translation', 'user.status_active'),
	    User::STATUS_DELETED => Yii::t('translation', 'user.status_inactive')
	];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['username', 'email'], function ($attribute, $params, $validator) {
		    if (!empty($this->id)) {
			$user = User::find()->where("id <> :id and {$attribute} = :{$attribute}", [':id'=>$this->id,":{$attribute}"=>$this->{$attribute}])->one();
			if(!empty($user)){
			    $this->addError($attribute, Yii::t('translation', 'user.message_unique_field', ['field'=>$this->getAttributeLabel($attribute)]));
			}
		    }
		}],
		['status', 'default', 'value' => self::STATUS_ACTIVE],
		['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
		[['updated_at'], 'safe']
	];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
	return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
	throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email) {
	return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUserName($username) {
	return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
	if (!static::isPasswordResetTokenValid($token)) {
	    return null;
	}

	return static::findOne([
		    'password_reset_token' => $token,
		    'status' => self::STATUS_ACTIVE,
	]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token) {
	if (empty($token)) {
	    return false;
	}

	$timestamp = (int) substr($token, strrpos($token, '_') + 1);
	$expire = Yii::$app->params['user.passwordResetTokenExpire'];
	return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
	return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
	return $this->auth_key;
    }

    public function generatePassword($quantity = 255) {
	return substr(Yii::$app->security->generateRandomString() . '_' . time(), 0, $quantity);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
	return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
	return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
	$this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
	$this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
	$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
	$this->password_reset_token = null;
    }

}
