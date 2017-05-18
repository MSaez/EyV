<?php

namespace app\controllers;

use Yii;
use app\models\Despacho;
use app\models\DespachoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;
use app\models\Usuario;

/**
 * DespachoController implements the CRUD actions for Despacho model.
 */
class DespachoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['imprimir', 'index', 'ingresardespacho', 'update', 'view', 'delete'],
                'rules' => [
                    //Para Administrador
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['imprimir', 'index', 'ingresardespacho', 'update', 'view', 'delete'],
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
                        'actions' => ['imprimir', 'index', 'ingresardespacho', 'update', 'view', 'delete'],
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

    /**
     * Lists all Despacho models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DespachoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Despacho model.
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
     * Creates a new Despacho model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIngresardespacho($ot)
    {
        $cobro = new \app\models\Cobros();
        $orden = new \app\models\Ot();
        $orden = \app\models\Ot::findOne($ot);
        $model = new Despacho();
        $model->OT_ID = $ot;
        $model->OD_FECHA = date("Y-m-d");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $orden->OT_ESTADO = 'Despachado';
            $orden->OD_ID = $model->OD_ID;
            $cobro->OT_ID = $ot;
            $cobro->CBR_VALOR = $model->oT->OT_TOTAL;
            $cobro->CBR_FECHA = date("Y-m-d");
            $cobro->save();
            $orden->CBR_ID = $cobro->CBR_ID;
            $orden->save();
            return $this->redirect(['view', 'id' => $model->OD_ID]);
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    /**
     * Updates an existing Despacho model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->OD_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionImprimir($id)
    {
        $model = $this->findModel($id);
        $ot = \app\models\Ot::find()->where('OT_ID = '.$model->OT_ID)->one();
        $vehiculo = \app\models\Vehiculo::find()->where('VEH_ID = '.$ot->VEH_ID)->one();
        
        
        $content = $this->renderPartial('imprimir-recibo',[            
            'model' => $model,
            'vehiculo' => $vehiculo,
        ]);
        
        $pdf = new Pdf([            
            'mode' => Pdf::MODE_CORE,             
            'format' => Pdf::FORMAT_A4,             
            'orientation' => Pdf::ORIENT_PORTRAIT,             
            'destination' => Pdf::DEST_DOWNLOAD,           
            'filename' => 'Comprobante_despacho_No '.$model->OD_ID.'.pdf',           
            'content' => $content,             
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',            
            'cssInline' => '.kv-heading-1{font-size:18px}',            
            'options' => ['title' => 'Comprobante_despacho_No '.$model->OD_ID],            
            'methods' => [ 
                //'SetHeader'=>['Krajee Report Header'], 
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    /**
     * Deletes an existing Despacho model.
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
     * Finds the Despacho model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Despacho the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Despacho::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
