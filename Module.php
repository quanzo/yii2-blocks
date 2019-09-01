<?php

namespace x51\yii2\modules\blocks;
use \yii\filters\AccessControl;
use models\Blocks;
use \Yii;

/**
 * blocks module definition class
 */
class Module extends \yii\base\Module
{
    public $name;
    public $description;

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'x51\yii2\modules\blocks\controllers';

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['blocks_manage'],
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
		if (!isset($this->module->i18n->translations['module/blocks'])) {
            $this->module->i18n->translations['module/blocks'] = [
                'class' => '\yii\i18n\PhpMessageSource',
                'basePath' => __DIR__.'/messages',
                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'module/blocks' => 'messages.php',
                ],
            ];
        }
        if (!$this->name) {
            $this->name = Yii::t('module/blocks', 'Blocks');
        }
        if (!$this->description) {
            $this->description = Yii::t('module/blocks', 'Manage blocks site.');
        }
    }

    public function getBlockByCode($code) {
        $element = Blocks::find()->where(['code'=>$code])->limit(1)->one();
        if (!empty($element)) {
            return $element;
        }
        return false;
    } // end getBlockContentByCode

    // реализация ISupportAdminPanel
    public function apModuleName() {
        return $this->name;
    }

    public function apModuleDesc() {
        return $this->description;
    }

    public function apAdminMenu() {
        return [
            ['label' => Yii::t('module/blocks', 'List'), 'url' => ['/'.$this->id]],            
            ['label' => Yii::t('module/blocks', 'Garbage'), 'url' => ['/'.$this->id.'/garbage']],
        ];
    }

} // end class
