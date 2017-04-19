<?php

namespace app\controllers;

use Yii;
use app\models\Insumo;
use app\models\InsumoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InsumoController implements the CRUD actions for Insumo model.
 */
class InsumoController extends Controller
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

        
    protected function findModel($id)
    {
        if (($model = Insumo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionConfirmarrecepcion($id)
    {
        $model = $this->findModel($id);
        if ($model->INS_RECIBIDO == 0)
        {
            $model->INS_RECIBIDO = 1;
            $model->save();
            return $this->redirect(array('ot/view','id'=>$model->OT_ID));
        }
        else
        {
            Yii::$app->session->setFlash('danger', 'La llegada de este insumo ya se ha confirmado previamente.');
            return $this->redirect(array('ot/view','id'=>$model->OT_ID));
        }
    }
}
