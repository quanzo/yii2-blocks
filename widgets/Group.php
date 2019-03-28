<?php
namespace x51\yii2\modules\blocks\widgets;

class Group extends Block
{
    public $group; // код группы для вывода
    public $order = 'ASC'; // направление сортировки блоков в группе

    public $before = ''; // контент, предваряющий вывод группы
    public $after = ''; // контент после вывода группы
    public $wrapview = NULL;

    /**
     * Выводит содержимое группы блоков
     *
     * @return void
     */
    public function run()
    {
        $result = '';
        if (!empty($this->group)) {
            if (defined('QUERY_CACHE_TIME')) {
                $cacheTime = QUERY_CACHE_TIME;
            } else {
                $cacheTime = 3600;
            }
            $query = \x51\yii2\modules\blocks\models\Blocks::find()->where(['bgroup' => $this->group])->andWhere(['>', 'active', 0]);
            if (strcasecmp($this->order, 'DESC') == 0) {
                $query->orderBy(['sort' => SORT_DESC]);
            } else {
                $query->orderBy(['sort' => SORT_ASC]);
            }
            if ($cacheTime > -1) {
                $query->cache($cacheTime);
            }
            $elements = $query->all();

            if ($elements) {
                foreach ($elements as $i => $element) {
                    $result .= $this->renderElement($element);
                }
                //var_dump($this->wrapview);
                if (!empty($this->wrapview) && is_string($this->wrapview)) {
                    $result = $this->render($this->wrapview, [
                        'content' => $result,
                    ]);
                } else {
                    $result = $this->before . $result . $this->after;
                }
            }
        }
        return $this->resultPrepare($result);
    } // end run
} // end class
