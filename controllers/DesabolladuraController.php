<?php

namespace app\controllers;

use Yii;
use app\models\ActividadDesabolladura;
use app\models\ActividadDesabolladuraSearch;
use app\models\EmpleadoForm;
use app\models\Empleado;
use app\models\EmpleadoSearch;
use app\models\Ot;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * DesabolladuraController implements the CRUD actions for ActividadDesabolladura model.
 */
class DesabolladuraController extends Controller
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

    // actualiza el estado de una actividad en particular
    public function actionActualizarestado($id)
    {
        $model = $this->findModel($id);
        $ot = new Ot();
        $ot = $model->getOT()->one();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionVertrabajadores($id){
        $model = $this->findModel($id);
        //$modelsEmpleados = $model->empleados;
        $searchModelEmpleado = new EmpleadoSearch();
        $searchModelEmpleado->EMP_RUT = $model->DES_ID;
        $dataProvider = $searchModelEmpleado->search(Yii::$app->request->queryParams);
         
         
         return $this->render('trabajadores', ['model' => $model,
                                               'dataProvider' => $dataProvider]);
        
    }

   
    // asigna un trabajador a una actividad en particular
    public function actionAsignartrabajador($id)
    {
        $model = new EmpleadoForm();
        $ot = new Ot();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $empleado = Empleado::findOne(['EMP_RUT' => $model->EMP_RUT]);
            $actDesabolladura = $this->findModel($id);
            $ot = $actDesabolladura->getOT()->one();
           
            try{
                $actDesabolladura->link('empleados', $empleado);
            } catch (\yii\db\Exception $e) {
                // setear un flash y volver a la pagina anterior
                Yii::$app->session->setFlash('danger', 'El trabajador seleccionado ya  ha sido asignado a esta actividad.');
                return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
                 
            }
            // en caso de un enlace correcto volver a la pagina de la ot relacionada
            Yii::$app->session->setFlash('success', 'Trabajador asignado exitosamente!');
            return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('asignar', ['model' => $model]);
        }
        
    }

    /**
     * Finds the ActividadDesabolladura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActividadDesabolladura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadDesabolladura::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
