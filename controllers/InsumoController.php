<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Insumo;
use app\models\Inventario;
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
                'only' => ['confirmarrecepcion'],
                'rules' => [
                    //Para Administrador
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['confirmarrecepcion'],
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
                        'actions' => ['confirmarrecepcion'],
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
    * Lists all Insumo models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new InsumoSearch();
	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
		           'searchModel' => $searchModel,
		           'dataProvider' => $dataProvider,
	]);
    }
		
    /**    
    * Displays a single Insumo model.
    * @param integer $id
    * @return mixed
    */
    public function actionView($id)
    {
        return $this->render('view', [
		           'model' => $this->findModel($id),
        ]);
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
        
        $model = new Insumo(['scenario' => 'existente']);
        $inventario = Inventario::find(['INV_ID' => $model->inventario_id])->one();
        $insumo_excedente = Insumo::find(['INS_ID' => $inventario->INS_ID])->one();
        $model->INS_REUTILIZADO = 1;
        $model->OT_ID = $ot;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
