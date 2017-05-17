<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\PasswordForm;


/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'index', 'view'],
                'rules' => [
                    //Para Administrador
                    [
                        'actions' => ['create', 'index', 'view', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Usuario::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                    //Para Usuario
                    [
                        'actions' => ['create', 'update', 'index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                             return $this->verificarUsuario(Yii::$app->user->identity->id);
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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
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
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();
        
        //Validación mediante ajax
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        $model->US_AUTHKEY = Yii::$app->getSecurity()->generateRandomString();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->US_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->US_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    /* Función para reestablecer la contraseña */
    public function actionResetPass($mail)
    {
        $model = Usuario::find()->where(['US_EMAIL'=>$mail])->one();
        $pass = "";
        $pass = rand(10000, 99999999);
        $msj = "Clave Cambiada. Nueva Clave Enviada al Correo: $model->US_EMAIL";
        Yii::$app->session->setFlash('success', $msj);
        $model->US_PASSWORD = $pass;
        if($model->save()){ // ver como usar el codigo de envio de emails
            Yii::$app->mail->compose()
            ->setFrom([\Yii::$app->params['supportEmail'] => 'Test Mail'])
            ->setTo($model->US_EMAIL)
            ->setSubject('Reseteo de contraseña' )
            ->setHtmlBody('<h2>Cambio de Clave de Acceso</h1><br><br>
            <h4>{$model->US_NOMBRES} {$model->US_PATERNO}: <br> &nbsp;Se realizó el cambio en su clave de acceso al sistema. Su nueva clave es {$model->US_PASSWORD} </h4><br>
            <h5>Se Recomienda por temas de seguridad, que cambie la clave de acceso. </h5>"')
            ->send();
            $this->redirect("index.php?r=usuario/admin"); 
        }else{
            return $this->render('resetpassword', [
                'model' => $model,
            ]);
        }
               		
             
    }
    
     // Función para el cambio de contraseña (mala)
    public function actionChangepassword(){
        $model = new PasswordForm();
        if($model->load(Yii::$app->request->post())){
            $modeluser = $this->findModel(Yii::$app->user->identity->US_ID);
            if($model->validate()){
                $modeluser->US_PASSWORD = $_POST['PasswordForm']['newpass'];
                $modeluser->save();
                Yii::$app->session->setFlash('success',$modeluser->US_PASSWORD);
                return $this->redirect(['index']);
            }else{
                return $this->render('changepassword',[
                    'model'=>$model
                ]);
            }
        }else{
            return $this->render('changepassword',[
                'model'=>$model
            ]);
        }
    }
    
    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
    
    protected function verificarUsuario($id)
    {
        $request = Yii::$app->request;
        $code = $request->get('id');
        if (($id == $code) && (Usuario::isUserSimple(Yii::$app->user->identity->id) == true)){
            return true;
        }
        else{
            return false;
        }
    }
}
