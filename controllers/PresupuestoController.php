<?php
namespace app\controllers;
use Yii;
use app\models\Usuario;
use app\models\Ot;
use app\models\PresupuestoSearch;
use app\models\OsModel;
use app\models\InModel;
use app\models\DesModel;
use app\models\PinModel;
use app\models\ActividadDesabolladura;
use app\models\ActividadDesabolladuraSearch;
use app\models\ImprimirActividadDesabolladuraSearch;
use app\models\ActividadPintura;
use app\models\ActividadPinturaSearch;
use app\models\ImprimirActividadPinturaSearch;
use app\models\Insumo;
use app\models\InsumoSearch;
use app\models\ImprimirInsumoSearch;
use app\models\OtrosServicios;
use app\models\OtrosServiciosSearch;
use app\models\ImprimirOtrosServiciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
/**
 * PresupuestoController implements the CRUD actions for Ot model.
 */
class PresupuestoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'index', 'view', 'confirmar', 'imprimir'],
                'rules' => [
                    //Para Administrador
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['create', 'update', 'index', 'view', 'confirmar', 'imprimir'],
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
                        'actions' => ['create', 'update', 'index', 'view', 'confirmar', 'imprimir'],
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
     * Lists all Ot models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PresupuestoSearch();
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
        $modelsPintura = $model->actividadPinturas;
        $modelsInsumo = $model->insumos;
        $modelsServicios = $model->otrosServicios;
        
        $searchModelDesabolladura = new ActividadDesabolladuraSearch();
        $searchModelDesabolladura->OT_ID = $model->OT_ID;
        $dataProviderDesabolladura = $searchModelDesabolladura->search(Yii::$app->request->queryParams);
        
        $searchModelPintura = new ActividadPinturaSearch();
        $searchModelPintura->OT_ID = $model->OT_ID;
        $dataProviderPintura = $searchModelPintura->search(Yii::$app->request->queryParams);
        
        $searchModelInsumo = new InsumoSearch();
        $searchModelInsumo->OT_ID = $model->OT_ID;
        $dataProviderInsumo = $searchModelInsumo->search(Yii::$app->request->queryParams);
        
        $searchModelServicios = new OtrosServiciosSearch();
        $searchModelServicios->OT_ID = $model->OT_ID;
        $dataProviderServicios = $searchModelServicios->search(Yii::$app->request->queryParams);
        
        return Yii::$app->controller->render('view',[
            'model' => $model,
            'modelsDesabolladura' => $modelsDesabolladura,
            'searchModelDesabolladura'=> $searchModelDesabolladura,
            'dataProviderDesabolladura'=> $dataProviderDesabolladura,
            'modelsPintura' => $modelsPintura,
            'searchModelPintura' => $searchModelPintura,
            'dataProviderPintura' => $dataProviderPintura,
            'modelsInsumo' => $modelsInsumo,
            'searchModelInsumo' => $searchModelInsumo,
            'dataProviderInsumo' => $dataProviderInsumo,
            'modelsServicios' => $modelsServicios,
            'seachModelServicios' => $searchModelServicios,
            'dataProviderServicios' => $dataProviderServicios
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
        $modelsPintura = [new ActividadPintura];
        $modelsInsumo = [new Insumo];
        $modelsServicios = [new OtrosServicios];
        
        if ($model->load(Yii::$app->request->post())) {
            // Para las actividades de desabolladura
            $modelsDesabolladura = DesModel::createMultiple(ActividadDesabolladura::classname());
            DesModel::loadMultiple($modelsDesabolladura, Yii::$app->request->post());
            
            // Para las actividades de pintura
            $modelsPintura = PinModel::createMultiple(ActividadPintura::classname());
            PinModel::loadMultiple($modelsPintura, Yii::$app->request->post());
            
            // Para los insumos
            $modelsInsumo = InModel::createMultiple(Insumo::classname());
            InModel::loadMultiple($modelsInsumo, Yii::$app->request->post());
            
            // Para los servicios externos
            $modelsServicios = OsModel::createMultiple(OtrosServicios::classname());
            OsModel::loadMultiple($modelsServicios, Yii::$app->request->post());
            // Validación AJAX
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsDesabolladura),
                    ActiveForm::validateMultiple($modelsPintura),
                    ActiveForm::validateMultiple($modelsInsumo),
                    ActiveForm::validateMultiple($modelsServicios),
                    ActiveForm::validate($model)
                );
            }
            // Validamos todos los modelos
            $valid = $model->validate();
            $valid = DesModel::validateMultiple($modelsDesabolladura) &&
                     PinModel::validateMultiple($modelsPintura) && 
                     InModel::validateMultiple($modelsInsumo) && 
                     OsModel::validateMultiple($modelsServicios) && $valid;
            
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
                        
                        /* ************************************************ */
                        
                        foreach ($modelsPintura as $modelPintura) {
                            $modelPintura->OT_ID = $model->OT_ID;
                            if (! ($flag = $modelPintura->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        
                        /* ************************************************ */
                        
                        foreach ($modelsInsumo as $modelInsumo) {
                            $modelInsumo->OT_ID = $model->OT_ID;
                            if (! ($flag = $modelInsumo->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        
                        /* ************************************************ */
                        
                        foreach ($modelsServicios as $modelServicios) {
                            $modelServicios->OT_ID = $model->OT_ID;
                            if (! ($flag = $modelServicios->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        
                        /* ************************************************ */
                        
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
            'modelsDesabolladura' => (empty($modelsDesabolladura)) ? [new ActividadDesabolladura] : $modelsDesabolladura,
            'modelsPintura' => (empty($modelsPintura)) ? [new ActividadPintura] : $modelsPintura,
            'modelsInsumo' => (empty($modelsInsumo)) ? [new Insumo] : $modelsInsumo,
            'modelsServicios' => (empty($modelsServicios)) ? [new OtrosServicios] : $modelsServicios,
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
        $model=$this->findModel($id);
        $modelsDesabolladura=$model->actividadDesabolladuras;
        $modelsPintura=$model->actividadPinturas;
        $modelsInsumo=$model->insumos;
        $modelsServicios=$model->otrosServicios;
        if ($model->load(Yii::$app->request -> post())){
            
            $oldIDsDesabolladura = ArrayHelper::map($modelsDesabolladura, 'DES_ID', 'DES_ID');
            $modelsDesabolladura = DesModel::createMultiple(ActividadDesabolladura::classname(), $modelsDesabolladura);
            DesModel::loadMultiple($modelsDesabolladura, Yii::$app->request->post());
            $deletedIDsDesabolladura = array_diff($oldIDsDesabolladura, array_filter(ArrayHelper::map($modelsDesabolladura, 'DES_ID', 'DES_ID')));
            
            /* ************************************ */
            
            $oldIDsPintura = ArrayHelper::map($modelsPintura, 'PIN_ID', 'PIN_ID');
            $modelsPintura = PinModel::createMultiple(ActividadPintura::classname(), $modelsPintura);
            PinModel::loadMultiple($modelsPintura, Yii::$app->request->post());
            $deletedIDsPintura = array_diff($oldIDsPintura, array_filter(ArrayHelper::map($modelsPintura, 'PIN_ID', 'PIN_ID')));
            
            /* ************************************ */
            
            $oldIDsInsumo = ArrayHelper::map($modelsInsumo, 'INS_ID', 'INS_ID');
            $modelsInsumo = InModel::createMultiple(Insumo::classname(), $modelsInsumo);
            InModel::loadMultiple($modelsInsumo, Yii::$app->request->post());
            $deletedIDsInsumo = array_diff($oldIDsInsumo, array_filter(ArrayHelper::map($modelsInsumo, 'INS_ID', 'INS_ID')));
            
            /* ************************************ */
            
            $oldIDsServicios = ArrayHelper::map($modelsServicios, 'OS_ID', 'OS_ID');
            $modelsServicios = OsModel::createMultiple(OtrosServicios::classname(), $modelsServicios);
            OsModel::loadMultiple($modelsServicios, Yii::$app->request->post());
            $deletedIDsServicios = array_diff($oldIDsServicios, array_filter(ArrayHelper::map($modelsServicios, 'OS_ID', 'OS_ID')));
            
            // Validación AJAX
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsDesabolladura),
                    ActiveForm::validateMultiple($modelsPintura),
                    ActiveForm::validateMultiple($modelsInsumo),
                    ActiveForm::validateMultiple($modelsServicios),
                    ActiveForm::validate($model)
                );
            }
            // Validamos todos los modelos
            $valid = $model->validate();
            $valid = DesModel::validateMultiple($modelsDesabolladura) &&
                     PinModel::validateMultiple($modelsPintura) &&
                     InModel::validateMultiple($modelsInsumo) &&
                     OsModel::validateMultiple($modelsServicios) && $valid;
            
             if ($valid) 
            {
                 $transaction = \Yii::$app->db->beginTransaction();
                 try {
                     if ($flag = $model -> save(false)){
                        
                        // Actividad de Desabolladura
                        if (! empty($deletedIDsDesabolladura)) {
                            ActividadDesabolladura::deleteAll(['DES_ID' => $deletedIDsDesabolladura]);
                        }
                        foreach ($modelsDesabolladura as $modelcom_desabolladura) {
                            $modelcom_desabolladura->OT_ID = $model->OT_ID;
                            if (! ($flag = $modelcom_desabolladura->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        
                        // Actividad de Pintura
                        
                        if (! empty($deletedIDsPintura)) {
                            ActividadPintura::deleteAll(['PIN_ID' => $deletedIDsPintura]);
                        }
                        foreach ($modelsPintura as $modelcom_pintura) {
                            $modelcom_pintura->OT_ID = $model->OT_ID;
                            if (! ($flag = $modelcom_pintura->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        
                        // Insumo
                        
                        if (! empty($deletedIDsInsumo)) {
                            Insumo::deleteAll(['INS_ID' => $deletedIDsInsumo]);
                        }
                        foreach ($modelsInsumo as $modelcom_insumo) {
                            $modelcom_insumo->OT_ID = $model->OT_ID;
                            if (! ($flag = $modelcom_insumo->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        
                        // Servicio Externo
                        
                        if (! empty($deletedIDsServicios)) {
                            OtrosServicios::deleteAll(['OS_ID' => $deletedIDsServicios]);
                        }
                        foreach ($modelsServicios as $modelcom_servicios) {
                            $modelcom_servicios->OT_ID = $model->OT_ID;
                            if (! ($flag = $modelcom_servicios->save(false))) {
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
        
        return $this->render('update', [
            'model' => $model,
            'modelsDesabolladura' => (empty($modelsDesabolladura)) ? [new ActividadDesabolladura] : $modelsDesabolladura,
            'modelsPintura' => (empty($modelsPintura)) ? [new ActividadPintura] : $modelsPintura,
            'modelsInsumo' => (empty($modelsInsumo)) ? [new Insumo] : $modelsInsumo,
            'modelsServicios' => (empty($modelsServicios)) ? [new OtrosServicios] : $modelsServicios
        ]);
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
     * Función que confirma un presupuesto para su ejecución
     */
    
    public function actionConfirmar($id)
    {
        $model = $this->findModel($id);
        $model->OT_ESTADO = "OT";
        $model->save();
        return $this->redirect(array('ot/view','id'=>$model->OT_ID));
        
    }
    
    public function actionImprimir($id) {
        $model = $this->findModel($id);
        $modelsDesabolladura = $model->actividadDesabolladuras;
        $modelsPintura = $model->actividadPinturas;
        $modelsInsumo = $model->insumos;
        $modelsServicios = $model->otrosServicios;
        
        $searchModelDesabolladura = new ImprimirActividadDesabolladuraSearch();
        $searchModelDesabolladura->OT_ID = $model->OT_ID;
        $dataProviderDesabolladura = $searchModelDesabolladura->search(Yii::$app->request->queryParams);
        
        $searchModelPintura = new ImprimirActividadPinturaSearch();
        $searchModelPintura->OT_ID = $model->OT_ID;        
        $dataProviderPintura = $searchModelPintura->search(Yii::$app->request->queryParams);
        
        $searchModelInsumo = new ImprimirInsumoSearch();
        $searchModelInsumo->OT_ID = $model->OT_ID;
        $dataProviderInsumo = $searchModelInsumo->search(Yii::$app->request->queryParams);
        
        $searchModelServicios = new ImprimirOtrosServiciosSearch();
        $searchModelServicios->OT_ID = $model->OT_ID;
        $dataProviderServicios = $searchModelServicios->search(Yii::$app->request->queryParams);
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('imprimir',[
            'model' => $model,
            'modelsDesabolladura' => $modelsDesabolladura,
            'searchModelDesabolladura'=> $searchModelDesabolladura,
            'dataProviderDesabolladura'=> $dataProviderDesabolladura,
            'modelsPintura' => $modelsPintura,
            'searchModelPintura' => $searchModelPintura,
            'dataProviderPintura' => $dataProviderPintura,
            'modelsInsumo' => $modelsInsumo,
            'searchModelInsumo' => $searchModelInsumo,
            'dataProviderInsumo' => $dataProviderInsumo,
            'modelsServicios' => $modelsServicios,
            'seachModelServicios' => $searchModelServicios,
            'dataProviderServicios' => $dataProviderServicios
        ]);
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_DOWNLOAD,
            // Nombre del archivo
            'filename' => 'Presupuesto_id_'.$model->OT_ID.'.pdf',
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [ 
                //'SetHeader'=>['Krajee Report Header'], 
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);
    
        // return the pdf output as per the destination setting
        return $pdf->render(); 
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
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}