<?php

namespace x51\yii2\modules\blocks\models;

/**
 * This is the ActiveQuery class for [[Blocks]].
 *
 * @see Blocks
 */
class BlocksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Blocks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Blocks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
