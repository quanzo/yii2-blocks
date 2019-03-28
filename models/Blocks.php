<?php

namespace x51\yii2\modules\blocks\models;

use Yii;
use \x51\yii2\modules\auth\classes\RoleRule;
use \x51\functions\funcString;

/**
 * This is the model class for table "{{%blocks}}".
 *
 * @property int $id
 * @property string $code
 * @property string $content
 */
class Blocks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blocks}}';
    }

    public function init()
    {
        parent::init();
        $this->on($this::EVENT_BEFORE_INSERT, [$this, 'onBeforeInsert']);
    }

    public function onBeforeInsert()
    {
        $this->setCurrentUserId();
        if (empty($this->sort)) {
            $this->sort = 100;
        }
    }

    public function setCurrentUserId()
    {
        $this->user_id = \Yii::$app->user->id;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'content'], 'required'],
            [['content', 'name', 'intro', 'epilog'], 'string'],
            [['code', 'bgroup'], 'string', 'max' => 75],
            [['comment', 'callback'], 'string', 'max' => 75],
            [['permission', 'route'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 250],
            [['sort', 'active'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('module/blocks', 'ID'),
            'code' => Yii::t('module/blocks', 'Code'),
            'sort' => Yii::t('module/blocks', 'Sort index'),
            'bgroup' => Yii::t('module/blocks', 'Group name'),
            'name' => Yii::t('module/blocks', 'Name'),
            'intro' => Yii::t('module/blocks', 'Intro'),
            'content' => Yii::t('module/blocks', 'Content'),
            'epilog' => Yii::t('module/blocks', 'Epilog'),
            'callback' => Yii::t('module/blocks', 'Callback'),
            'active' => Yii::t('module/blocks', 'Active'),
            'permission' => Yii::t('module/blocks', 'Only for permission'),
            'route' => Yii::t('module/blocks', 'Only for route (use mask * ?)'),
            'comment' => Yii::t('module/blocks', 'Comment'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BlocksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlocksQuery(get_called_class());
    }

    public function getCanView()
    {
        $result = true;
        if (!empty($this->permission)) {
            //$arPerm = explode(',', $this->permission);
			$arPerm = funcString::explode([',', ' '], $this->permission, true);
            array_walk($arPerm, function (&$val, $key) {
                $val = trim($val);
            });
            if (empty(RoleRule::choosePermissions($arPerm)) && empty(RoleRule::chooseRoles($arPerm))) {
                $result = false;
            }
        }

        if ($result && !empty($this->route)) {
            $currRoute = \Yii::$app->controller->route;
            $arRoutesView = funcString::explode([',', ' '], $this->route, true);
            if ($arRoutesView) {
                $match = false;
                foreach ($arRoutesView as $path) {
                    $match = fnmatch($path, $currRoute);
                    if ($match) {
                        break;
                    }
                }
                $result = $match;
            }
        }
        return $result;
    } // end getCanView
} // end class
