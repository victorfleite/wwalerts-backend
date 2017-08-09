<?php

namespace webapp\modules\risk\models\base;

use Yii;

/**
 * This is the base model class for table "risk.event_type".
 *
 * @property integer $id
 * @property string $name_i18n
 * @property string $description_i18n
 * @property integer $status
 * @property string $abbrev
 *
 * @property \webapp\modules\risk\models\RiskEvent[] $riskEvents
 */
class EventType extends \yii\db\ActiveRecord
{

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'riskEvents'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_i18n'], 'required'],
            [['status'], 'integer'],
            [['name_i18n', 'description_i18n'], 'string', 'max' => 300],
            [['abbrev'], 'string', 'max' => 16]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'risk.event_type';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'name_i18n' => Yii::t('translation', 'Name I18n'),
            'description_i18n' => Yii::t('translation', 'Description I18n'),
            'status' => Yii::t('translation', 'Status'),
            'abbrev' => Yii::t('translation', 'Abbrev'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiskEvents()
    {
        return $this->hasMany(\webapp\modules\risk\models\RiskEvent::className(), ['event_type_id' => 'id']);
    }
    }
