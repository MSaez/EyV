<?php

namespace app\controllers;

use Yii;
use app\models\Ot;
use app\models\OtSearch;
use app\models\Model;
use app\models\ActividadDesabolladura;
use app\models\ActividadDesabolladuraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * OtController implements the CRUD actions for Ot model.
 */
class OtController extends Controller
{
    /**
     * @inheritdoc
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
        ];
    }

    /**
     * Lists all Ot models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OtSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ot model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelsDesabolladura = $model->actividadDesabolladuras;
        
        $searchModel = new ActividadDesabolladuraSearch();
        $searchModel->OT_ID = $model->OT_ID;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return Yii::$app->controller->render('view',[

            'model' => $model,
            'modelsDesabolladura' => $modelsDesabolladura,
            'searchModel'=> $searchModel,
            'dataProvider'=> $dataProvider,

        ]);
        
    }

    /**
     * Creates a new Ot model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ot();
        $modelsDesabolladura = [new ActividadDesabolladura];
        if ($model->load(Yii::$app->request->post())) {

            $modelsDesabolladura = Model::createMultiple(ActividadDesabolladura::classname());
            Model::loadMultiple($modelsDesabolladura, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsDesabolladura),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDesabolladura) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDesabolladura as $modelDesabolladura) {
                            $modelDesabolladura->OT_ID = $model->OT_ID;
                            if (! ($flag = $modelDesabolladura->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->OT_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsDesabolladura' => (empty($modelsDesabolladura)) ? [new ActividadDesabolladura] : $modelsDesabolladura
        ]);
    }
    

    /**
     * Updates an existing Ot model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->OT_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ot model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ot::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
