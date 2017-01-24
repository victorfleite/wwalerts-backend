<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 * @property integer $status
 *
 * @property Professor $professor
 * @property Profile $profile
 * @property RlEscolaResponsavel[] $rlEscolaResponsavels
 * @property Escola[] $idEscolas
 * @property RlTurmaAluno[] $rlTurmaAlunos
 * @property Turma[] $idTurmas
 * @property SocialAccount[] $socialAccounts
 * @property Token[] $tokens
 * @property TuxmathMissionAnswered[] $tuxmathMissionAnswereds
 */
class User extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'status'], 'integer'],
            [['username', 'email', 'unconfirmed_email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'unconfirmed_email' => Yii::t('app', 'Unconfirmed Email'),
            'blocked_at' => Yii::t('app', 'Blocked At'),
            'registration_ip' => Yii::t('app', 'Registration Ip'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'flags' => Yii::t('app', 'Flags'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessor() {
        return $this->hasOne(Professor::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile() {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlEscolaResponsavels() {
        return $this->hasMany(RlEscolaResponsavel::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEscolas() {
        return $this->hasMany(Escola::className(), ['id' => 'id_escola'])->viaTable('rl_escola_responsavel', ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRlTurmaAlunos() {
        return $this->hasMany(RlTurmaAluno::className(), ['id_aluno' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTurmas() {
        return $this->hasMany(Turma::className(), ['id' => 'id_turma'])->viaTable('rl_turma_aluno', ['id_aluno' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialAccounts() {
        return $this->hasMany(SocialAccount::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens() {
        return $this->hasMany(Token::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTuxmathMissionAnswereds() {
        return $this->hasMany(TuxmathMissionAnswered::className(), ['user_id' => 'id']);
    }
    /**
     *  Method to update user data from api central every time after the user login
     * @param type $login
     * @throws \Exception
     */
    static function updateUserDataFromApiCentral($login) {
        // Update user data from api-central
        $uri = \Yii::$app->config->getVar("API_CENTRAL_URL_ADDRESS"). \app\models\Constantes::API_CENTRAL_GET_USER_DATA;
        $config = \Yii::$app->config->getVars();
        $params = [
            "serverid" => $config['SERVERID'],
            "masterkey" => $config['MASTERKEY'],
            "email" => $login
        ];
        $response = \Httpful\Request::post($uri)
                ->addHeaders(array(
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ))->body(\yii\helpers\Json::encode($params))
                ->send();
        if (!empty($response->body->success == "ok") && !empty($response->body->user)) {
            
            $user = self::find()->where(['email'=>$login])->one();
            if(empty($user)) $user = new User;
            $user->setAttributes(ArrayHelper::toArray($response->body->user), false);
            $user->save();
            
        } elseif (!empty($response->body->success == "error") && $response->body->message == "access-forbidden") {
            throw new \Exception("Access forbidden in api-central. Check if serverid or masterkey are iguals in api-central and api-escola.");
        }
    }

}
