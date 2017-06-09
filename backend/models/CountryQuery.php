<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Country]].
 *
 * @see Country
 */
class CountryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Country[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Country|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}