<?php

namespace x51\yii2\modules\blocks\controllers;

use \Yii;
use x51\yii2\modules\blocks\models\Blocks;
use x51\yii2\modules\blocks\models\BlocksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\filters\AccessControl;
use \yii\base\DynamicModel;


/**
 * DefaultController implements the CRUD actions for Blocks model.
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

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
     * Lists all Blocks models.
     * @return mixed
     */
    public function actionIndex()
    {
        // групповая операция
        $request = \Yii::$app->request;
        if ($request->post('operation', false) && $request->post('sel', false)) {
            $pmKey = Blocks::primaryKey();
            if (is_array($pmKey)) {
                $pmKey = current($pmKey);
            }
            $op = $request->post('operation');
            $sel = $request->post('sel', false);
            foreach ($sel as &$id) {
                $id = intval($id);
            }
            switch ($op) {
                case 'set-group': {
                    $validateModel = new DynamicModel([
                        'bgroup' => $request->post('new-group', '')
                    ]);
                    $validateModel->addRule(
                        'bgroup', 'string', ['max'=>75]
                    )->addRule(
                        'bgroup', 'safe'
                    )->validate();

                    if (!$validateModel->hasErrors()) {
                        Blocks::updateAll(
                            ['bgroup' => $validateModel->bgroup],
                            [$pmKey => $sel]
                        );
                    }               
                    break;
                }
                case 'delete': {
                    Blocks::deleteAll([$pmKey => $sel]);
                    break;
                }
            }
        }
        
        $searchModel = new BlocksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blocks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blocks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blocks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Blocks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //print_r($model);
       

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        //var_dump($model);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Blocks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Duplicate record
     *
     * @param integer $id
     * @return void
     */
    public function actionDuplicate($id) {
        if ($curr = $this->findModel($id)) {
            $dup = new Blocks();
            $buff = $curr->attributes;
            $arPmKey = Blocks::primaryKey();
            foreach ($arPmKey as $key) {
                unset($buff[$key]);
            }
            $buff['code'] = $buff['code'].rand(1, 99);
            $dup->attributes = $buff;
            try {
                $dup->save();
            } catch (Exception $e) {
                //$e->getMessage()
            }
        }
        return $this->redirect(['index']);

    }

    /**
     * Finds the Blocks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blocks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blocks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('module/blocks', 'The requested page does not exist.'));
    }
}
