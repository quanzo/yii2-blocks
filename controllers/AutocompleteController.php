<?php

namespace x51\yii2\modules\blocks\controllers;
use yii\web\Controller;

class AutocompleteController extends Controller
{
    public function behaviors()
    {
        return [
            'bootstrap' => [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionIndex() {}

    public function actionGroup($term)
    {
        $arGroup = \x51\yii2\modules\blocks\models\Blocks::find()
            ->select(['bgroup'])
            ->distinct()
            ->where(['like', 'bgroup', $term])
            ->limit(50)
            ->cache(30)
            ->all();
        $result = [];
        foreach ($arGroup as $i => $e) {
            $result[] = ['label'=>$e->bgroup];
        }
        return $result;
    }

    public function actionCode($term)
    {
        $arCode = \x51\yii2\modules\blocks\models\Blocks::find()
            ->select(['code'])
            ->distinct()
            ->where(['like', 'code', $term])
            ->limit(50)
            ->cache(30)
            ->all();
        $result = [];
        foreach ($arCode as $i => $e) {
            $result[] = ['label'=>$e->code];
        }
        return $result;
    }


} // end class
