<?php
namespace x51\yii2\modules\blocks\widgets;

class Block extends \yii\base\Widget
{
    public $code;
    public $beforeElement = ''; // контент до элемента, может быть callable. Может отменить вывод.
    public $afterElement = ''; // контент после элемента, может быть callable
    public $view = 'default'; // шаблон для вывода элемента. задать в виде имени или класса
    public $shortcode = true;

    public function run()
    {
        $result = '';
        if (!empty($this->code)) {
            if (defined('QUERY_CACHE_TIME')) {
                $cacheTime = QUERY_CACHE_TIME;
            } else {
                $cacheTime = 3600;
            }
            $query = \x51\yii2\modules\blocks\models\Blocks::find()->where(['code' => $this->code])->andWhere(['>', 'active', 0])->limit(1);
            if ($cacheTime > -1) {
                $query->cache($cacheTime);
            }

            $element = $query->one();
            return $this->resultPrepare(
                $this->renderElement($element)
            );
        }
        return $result;
    } // end run

    protected function resultPrepare($content)
    {
        if ($this->shortcode && class_exists('\x51\classes\shortcode\Shortcode', true)) {
            $stop = false;
            $shortcodeProcess = \x51\classes\shortcode\Shortcode::getInstance();
            do {
                $res_content = $shortcodeProcess->process($content, true);
                if ($content == $res_content) { // break
                    $stop = true;
                } else {
                    $content = $res_content;
                }
            } while (!$stop);
        }
        return $content;
    }

    protected function renderElement($element)
    {
        $result = '';
        if ($element && $element->canView) {
            $next = $element->canView;
            $beforeElement = '';
            $contentElement = '';
            $afterElement = '';
            if ($next) {
                if (is_callable($this->beforeElement)) {
                    $f = $this->beforeElement;
                    $beforeElement = $f($element);
                    if ($beforeElement === false) {
                        $next = false;
                    }
                } else {
                    $beforeElement = $this->beforeElement;
                }
            }
            if ($next) {
                $call = $element->callback;
                $contentElement = $element->content;
                if (!empty($call)) {
                    if (is_callable($call)) {
                        try {
                            $contentElement = $call($element->content);
                        } catch (\Exception $e) {}
                    } elseif (class_exists($element->callback) && method_exists($element->callback, 'run')) {
                        try {
                            $contentElement = $call::run($element->content);
                        } catch (\Exception $e) {}
                    } else {
                        if (substr_count($call, '/') > 1) {
                            try {
                                $contentElement = \Yii::$app->runAction($call, ['internal' => true]);
                            } catch (\Exception $e) {}
                        }
                    }
                }
                if ($contentElement) {
                    if (is_callable($this->afterElement)) {
                        $f = $this->afterElement;
                        $afterElement = $f($element);
                    } else {
                        $afterElement = $this->afterElement;
                    }
                    // возможный вывод через шаблон
                    if (!empty($this->view) && is_string($this->view)) {
                        $result = $this->render($this->view, [
                            'element' => $element,
                            'beforeElement' => $beforeElement,
                            'contentElement' => $contentElement,
                            'afterElement' => $afterElement,
                        ]);
                    } else {
                        $result = $beforeElement . $contentElement . $afterElement;
                    }
                }
            }
        }
        return $result;
    } // end renderElement
} //end class
