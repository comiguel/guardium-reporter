<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Campo]].
 *
 * @see Campo
 */
class CampoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Campo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Campo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
