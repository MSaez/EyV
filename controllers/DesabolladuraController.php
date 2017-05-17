<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\ActividadDesabolladura;
use yii\data\SqlDataProvider;
use app\models\EmpleadoForm;
use app\models\Empleado;
use app\models\Ot;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;



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
            $this->comprobarDesabolladura($id);
            return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
        } else {
            return $this->render('_form', ['model' => $model,]);
        }
    }
    
    
    public function actionVertrabajadores($id){
        
        $actDesabolladura = $this->findModel($id);
        $count = Yii::$app->db->createCommand('
            SELECT COUNT(*) 
            FROM empleado, responsable_desabolladura 
            WHERE responsable_desabolladura.DES_ID =:id AND empleado.EMP_RUT = responsable_desabolladura.EMP_RUT
            ', [':id' => $id])->queryScalar();
        
        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT empleado.EMP_RUT, empleado.EMP_NOMBRES, empleado.EMP_PATERNO, empleado.EMP_MATERNO FROM empleado, responsable_desabolladura WHERE responsable_desabolladura.DES_ID =:id AND empleado.EMP_RUT = responsable_desabolladura.EMP_RUT',
            'params' => [':id' => $id],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        $dataProvider->key = 'EMP_RUT';
        $session = Yii::$app->session;
        $session['desabolladuraId'] = $id;

        
        return $this->render('trabajadores', [/*'model' => $model,*/
                                             'dataProvider' => $dataProvider,
                                             'actDesabolladura' => $actDesabolladura]);
        
    }

   
    // asigna un trabajador a una actividad en particular
    public function actionAsignartrabajador($id)
    {
        $model = new EmpleadoForm();
        $ot = new Ot();
        $actDesabolladura = $this->findModel($id);
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
            return $this->render('asignar', ['model' => $model,
                                             'actDesabolladura' => $actDesabolladura]);
        }
        
    }
    
    // Función para eliminar una asignación de un Empleado a una Actividad
    public function actionEliminar($idDesabolladura, $empRut){
        $ot = new Ot();
        $actDesabolladura = $this->findModel($idDesabolladura);
        $empleado = Empleado::findOne(['EMP_RUT' => $empRut]);
        //eliminamos variable de sesion
        $session = Yii::$app->session;
        $session->remove('desabolladuraId');
        $ot = $actDesabolladura->getOT()->one();
        try{
            // eliminamos de la tabla relacional
            $actDesabolladura->unlink('empleados', $empleado, $delete = true);
        }catch(\yii\db\Exception $e) {
            // setear un flash y volver a la pagina anterior
            Yii::$app->session->setFlash('danger', 'No se puede realizar esta operación');
            return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
        }
        // en caso de una eliminación correcta volver a la pagina de la ot relacionada
            Yii::$app->session->setFlash('success', 'Trabajador desvinculado de la actividad exitosamente!');
            return $this->redirect(array('ot/view','id'=>$ot->OT_ID));
    }
    
    public function comprobarDesabolladura($id){
        $actDesabolladura = $this->findModel($id);
        $ot = new Ot();
        $ot = $actDesabolladura->getOT()->one();
        $modelsDesabolladura = $ot->actividadDesabolladuras;
        if (!empty($modelsDesabolladura)){
            foreach ($modelsDesabolladura as $des) {
                if ($des->DES_ESTADO == 'Pendiente' || $des->DES_ESTADO == 'Ejecutando' ){
                    $ot->OT_EDES = 'Pendiente';
                    $ot->save();
                    $this->comprobarTerminoTrabajos($id);
                    break;
                }else{
                    $ot->OT_EDES = 'Terminado';
                    $ot->save();
                    $this->comprobarTerminoTrabajos($id);
                }
            }
        }
        $this->comprobarTerminoTrabajos($id);
    }
    
    public function comprobarTerminoTrabajos($id){
        $actDesabolladura = $this->findModel($id);
        $ot = new Ot();
        $ot = $actDesabolladura->getOT()->one();
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
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
