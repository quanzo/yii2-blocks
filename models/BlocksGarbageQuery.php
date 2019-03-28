<?php

namespace x51\yii2\modules\blocks\models;

/**
 * This is the ActiveQuery class for [[BlocksGarbage]].
 *
 * @see BlocksGarbage
 */
class BlocksGarbageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BlocksGarbage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BlocksGarbage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
