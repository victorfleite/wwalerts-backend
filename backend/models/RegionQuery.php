<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Region]].
 *
 * @see Region
 */
class RegionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Region[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Region|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}