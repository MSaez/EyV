<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Insumo;
use app\models\Inventario;
use app\models\Ot;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Exception;
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['confirmarrecepcion', 'create'],
                'rules' => [
                    //Para Administrador
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['confirmarrecepcion', 'create'],
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
                        'actions' => ['confirmarrecepcion', 'create'],
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

        
    protected function findModel($id)
    {
        if (($model = Insumo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
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
    
   
		
    /**
    * Esta función utilizará AJAX para rellenar el resto de los campos a excepción de INS_CANTIDAD e INS_TOTAL
    * Será necesario implementar las funciones para obtener los datos y enviarlos via AJAX
    */
    public function actionCreate($ot, $status)
    {
        if ($status != 'presupuesto' && $status != 'ot'){
            throw new Exception("Algo salió mal!");
        }
        $ot = Ot::find()->where(['OT_ID' => $ot])->one();
        $model = new Insumo(['scenario' => 'existente']);
        $model->INS_REUTILIZADO = 1;
        $model->OT_ID = $ot;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $inventario = Inventario::find()->where(['INV_ID' => $model->inventario_id])->one();
            $insumo_excedente = Insumo::find()->where(['INS_ID' => $inventario->INS_ID])->one();            
            if ($inventario->INV_CANTIDAD == $model->INS_CANTIDAD){
                // En caso de usar todo lo almacenado en bodega se procedera a cortar los enlaces que posea y eliminar el registro de la bodega
                $inventario->INV_CANTIDAD = 0;
                $insumo_excedente->INV_ID = null;
                $inventario->INS_ID = null;
                $inventario->save();
                $insumo_excedente->save();
                $inventario->delete();  
            }
            else{
                // En caso contrario solo se descontará lo sacado de bodega
                $inventario->INV_CANTIDAD = $inventario->INV_CANTIDAD - $model->INS_CANTIDAD;
                $inventario->save();
            }
            // Actualizamos el precio total de insumos reutilizados en caso de 
            // que el insumo se agregara desde una orden de trabajo
            if ($status == 'ot'){
                $ot->OT_TREUTILIZADO = $ot->OT_TREUTILIZADO + $model->INS_TOTAL;
                $ot->save();                
            }
            // Redirecciona según donde se agregó el insumo
            if ($status == 'presupuesto'){
                return $this->redirect(array('presupuesto/view','id'=>$ot));
            }else {
                throw new Exception("No puede usar esta función.");
            }
            if ($status == 'ot'){
                return $this->redirect(array('ot/view','id'=>$ot));
            }
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }
}
