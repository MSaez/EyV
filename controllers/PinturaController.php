<?php

namespace app\controllers;

use Yii;
use app\models\ActividadPintura;
use yii\data\SqlDataProvider;
use app\models\EmpleadoForm;
use app\models\Empleado;
use app\models\Ot;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PinturaController implements the CRUD actions for ActividadPintura model.
 */
class PinturaController extends Controller
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
            return $this->renderPartial('_form', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionVertrabajadores($id){
        
        
        $count = Yii::$app->db->createCommand('
            SELECT COUNT(*) 
            FROM empleado, responsable_pintura 
            WHERE responsable_pintura.PIN_ID =:id AND empleado.EMP_RUT = responsable_pintura.EMP_RUT
            ', [':id' => $id])->queryScalar();
        
        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT empleado.EMP_RUT, empleado.EMP_NOMBRES, empleado.EMP_PATERNO, empleado.EMP_MATERNO FROM empleado, responsable_pintura WHERE responsable_pintura.PIN_ID =:id AND empleado.EMP_RUT = responsable_pintura.EMP_RUT',
            'params' => [':id' => $id],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        $dataProvider->key = 'EMP_RUT';
        $session = Yii::$app->session;
        $session['pinturaId'] = $id;

        
        return $this->renderPartial('trabajadores', [/*'model' => $model,*/
                                             'dataProvider' => $dataProvider]);
        
    }

    
    public function actionAsignartrabajador($id)
    {
        $model = new EmpleadoForm();
        $ot = new Ot();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $empleado = Empleado::findOne(['EMP_RUT' => $model->EMP_RUT]);
            $actPintura = $this->findModel($id);
            $ot = $actPintura->getOT()->one();
           
            try{
                $actPintura->link('empleados', $empleado);
            } catch (\yii\db\Exception $e) {
                // setear un flash y volver a la pagina anterior
                Yii::$app->session->setFlash('danger', 'El trabajador seleccionado ya  ha sido asignado a esta actividad.');
                return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
                //return $this->redirect(array('ot/view','id'=>$ot->OT_ID)); 
            }
            // en caso de un enlace correcto volver a la pagina de la ot relacionada
            Yii::$app->session->setFlash('success', 'Trabajador asignado exitosamente!');
            return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->renderAjax('asignar', ['model' => $model]);
        }
        
    }
    
    // Función para eliminar una asignación de un Empleado a una Actividad
    public function actionEliminar($idPintura, $empRut){
        $ot = new Ot();
        $actPintura = $this->findModel($idPintura);
        $empleado = Empleado::findOne(['EMP_RUT' => $empRut]);
        //eliminamos variable de sesion
        $session = Yii::$app->session;
        $session->remove('pinturaId');

        $ot = $actPintura->getOT()->one();
        try{
            // eliminamos de la tabla relacional
            $actPintura->unlink('empleados', $empleado, $delete = true);
        }catch(\yii\db\Exception $e) {
            // setear un flash y volver a la pagina anterior
            Yii::$app->session->setFlash('danger', 'No se puede realizar esta operación');
            return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
        }
        // en caso de una eliminación correcta volver a la pagina de la ot relacionada
            Yii::$app->session->setFlash('success', 'Trabajador desvinculado de la actividad exitosamente!');
            return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
    }

    /**
     * Finds the ActividadPintura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActividadPintura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadPintura::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
