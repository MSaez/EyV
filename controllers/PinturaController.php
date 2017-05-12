<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\ActividadPintura;
use yii\data\SqlDataProvider;
use app\models\EmpleadoForm;
use app\models\Empleado;
use app\models\Ot;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['actualizarestado', 'asignartrabajador', 'eliminar', 'vertrabajadores'],
                'rules' => [
                    //Para Administrador
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['actualizarestado', 'asignartrabajador', 'eliminar', 'vertrabajadores'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return Usuario::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                    //Para Usuario
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['actualizarestado', 'asignartrabajador', 'eliminar', 'vertrabajadores'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return Usuario::isUserSimple(Yii::$app->user->identity->id);
                        },
                    ],
                ],
            ],
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
            $this->comprobarPintura($id);
            return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionVertrabajadores($id){
        
        $actPintura = $this->findModel($id);
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

        
        return $this->render('trabajadores', [/*'model' => $model,*/
                                             'dataProvider' => $dataProvider,
                                             'actPintura' => $actPintura]);
        
    }

    
    public function actionAsignartrabajador($id)
    {
        $model = new EmpleadoForm();
        $ot = new Ot();
        $actPintura = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $empleado = Empleado::findOne(['EMP_RUT' => $model->EMP_RUT]);
            $ot = $actPintura->getOT()->one();
           
            try{
                $actPintura->link('empleados', $empleado);
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
            return $this->render('asignar', ['model' => $model,
                                             'actPintura' => $actPintura]);
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
    
    public function comprobarPintura($id){
        $actPintura = $this->findModel($id);
        $ot = new Ot();
        $ot = $actPintura->getOT()->one();
        $modelsPintura = $ot->actividadPinturas;
        if (!empty($modelsPintura)){
            foreach ($modelsPintura as $pin) {
                if ($pin->PIN_ESTADO == 'Pendiente' || $pin->PIN_ESTADO == 'Ejecutando' ){
                    $ot->OT_EPIN = 'Pendiente';
                    $ot->save();
                    $this->comprobarTerminoTrabajos($id);
                    break;
                }else{
                    $ot->OT_EPIN = 'Terminado';
                    $ot->save();
                    $this->comprobarTerminoTrabajos($id);
                }
            }
        }
        $this->comprobarTerminoTrabajos($id);
    }
    
    public function comprobarTerminoTrabajos($id){
        $actPintura = $this->findModel($id);
        $ot = new Ot();
        $ot = $actPintura->getOT()->one();
        $estado_desabolladura = $ot->OT_EDES;
        $estado_pintura = $ot->OT_EPIN;
        // si no hay registrada ninguna actividad se considerará como "Cancelado"
        if ($estado_desabolladura == null && $estado_pintura == null){
            $ot->OT_ESTADO = 'Cancelado';
            $ot->save();
        }
        // Si solo hay registradas actividades de desabolladura se procede a comprobar
        if ($estado_desabolladura == 'Pendiente' && $estado_pintura == null){
            $ot->OT_ESTADO = 'OT';
            $ot->save();
        }
        if ($estado_desabolladura == 'Terminado' && $estado_pintura == null){
            $ot->OT_ESTADO = 'Terminado';
            $ot->save();
        }
        // Si solo hay registradas actividades de pintura se procede a comprobar
        if ($estado_desabolladura == null && $estado_pintura == 'Pendiente'){
            $ot->OT_ESTADO = 'OT';
            $ot->save();
        }
        if ($estado_desabolladura == null && $estado_pintura == 'Terminado'){
            $ot->OT_ESTADO = 'Terminado';
            $ot->save();
        }
        // En caso de haber ambos tipos de actividades se procede a comprobar
        if ($estado_desabolladura == 'Pendiente' && $estado_pintura == 'Pendiente'){
            $ot->OT_ESTADO = 'OT';
            $ot->save();
        }
        if ($estado_desabolladura == 'Pendiente' && $estado_pintura == 'Terminado'){
            $ot->OT_ESTADO = 'OT';
            $ot->save();
        }
        if ($estado_desabolladura == 'Terminado' && $estado_pintura == 'Pendiente'){
            $ot->OT_ESTADO = 'OT';
            $ot->save();
        }
        if ($estado_desabolladura == 'Terminado' && $estado_pintura == 'Terminado'){
            $ot->OT_ESTADO = 'Terminado';
            $ot->save();
        }
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
