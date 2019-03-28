<?php

namespace x51\yii2\modules\blocks\models;

use Yii;

/**
 * This is the model class for table "{{%blocks_garbage}}".
 *
 * @property int $id
 * @property string $code
 * @property int $sort
 * @property string $group
 * @property string $content
 * @property string $comment
 * @property string $callback
 * @property int $user_id
 * @property int $garbage_id
 * @property string $garbage_date
 * @property string $garbage_op
 */
class BlocksGarbage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blocks_garbage}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'user_id', 'active'], 'integer'],
            [['code', 'content'], 'required'],
            [['content', 'name', 'intro', 'epilog'], 'string'],
            [['garbage_date'], 'safe'],
            [['code', 'bgroup', 'comment', 'callback'], 'string', 'max' => 75],
            [['permission', 'route'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 250],
            [['garbage_op'], 'string', 'max' => 9],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('modules/blocks', 'ID'),
            'code' => Yii::t('modules/blocks', 'Code'),
            'sort' => Yii::t('modules/blocks', 'Sort'),
            'bgroup' => Yii::t('modules/blocks', 'Group'),
            'name' => Yii::t('modules/blocks', 'Name'),
            'intro' => Yii::t('modules/blocks', 'Intro'),
            'content' => Yii::t('modules/blocks', 'Content'),
            'epilog' => Yii::t('modules/blocks', 'Epilog'),
            'comment' => Yii::t('modules/blocks', 'Comment'),
            'callback' => Yii::t('modules/blocks', 'Callback'),
			'active' => Yii::t('modules/blocks', 'Active'),
            'permission' => Yii::t('modules/blocks', 'Permission'),
            'route' => Yii::t('modules/blocks', 'Route'),
            'user_id' => Yii::t('modules/blocks', 'User ID'),
            'garbage_id' => Yii::t('modules/blocks', 'Garbage ID'),
            'garbage_date' => Yii::t('modules/blocks', 'Garbage Date'),
            'garbage_op' => Yii::t('modules/blocks', 'Garbage Op'),
			/*'id' => 'ID',
            'code' => 'Code',
            'sort' => 'Sort',
            'group' => 'Group',
            'content' => 'Content',
            'comment' => 'Comment',
            'callback' => 'Callback',
            'user_id' => 'User ID',
            'garbage_id' => 'Garbage ID',
            'garbage_date' => 'Garbage Date',
            'garbage_op' => 'Garbage Op',*/
        ];
    }

    /**
     * {@inheritdoc}
     * @return BlocksGarbageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlocksGarbageQuery(get_called_class());
    }
}
