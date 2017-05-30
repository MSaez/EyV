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
use app\models\ResetPassForm;



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
        $pass = Yii::$app->security->generateRandomString(10);
        
        //Validación mediante ajax
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        $model->US_AUTHKEY = Yii::$app->getSecurity()->generateRandomString();
        $model->setPassword($pass);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->mailer->compose()
                ->setFrom(['mail@gmail.com' => 'Sistema de Gestión de reparaciones Estrada y Veloso Ltda.'])
                ->setTo($model->US_EMAIL)
                ->setSubject('Registro en sistema Estrada y Veloso' )
                ->setHtmlBody('<h2>Registro en sistema Estrada y Veloso</h2>
                               <br>
                               <br>
                               <h4>'.$model->nombreCompleto.':
                               <br>Se realizó el registro de su cuenta en el sistema. Su contraseña es: '.
                               $pass.'</h4><br>
                               <h4>Se Recomienda por temas de seguridad, que cambie la contraseña. </h4>')
                ->send();
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
    public function actionResetPassword()
    {
        $model = new ResetPassForm();
        $pass = "";
        $msj = "";
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $usuario = Usuario::findByEmail($model->email);
            $pass = Yii::$app->security->generateRandomString(10);
            $model->resetPassword($model->email, $pass);
            $msj = "Contraseña Cambiada. Nueva contraseña enviada al correo: $usuario->US_EMAIL";
            Yii::$app->session->setFlash('success', $msj);
            Yii::$app->mailer->compose()
                ->setFrom(['mail@gmail.com' => 'Sistema de Gestión de reparaciones Estrada y Veloso Ltda.'])
                ->setTo($usuario->US_EMAIL)
                ->setSubject('Reseteo de contraseña' )
                ->setHtmlBody('<h2>Reseteo de contraseña</h2>
                               <br>
                               <br>
                               <h4>'.$usuario->nombreCompleto.':
                               <br>Se realizó el cambio en su contraseña de acceso al sistema. Su nueva contraseña es: '.
                               $pass.'</h4><br>
                               <h4>Se Recomienda por temas de seguridad, que cambie la contraseña. </h4>')
                ->send();
            $this->redirect("@web");                 
            
        }else{
            return $this->render('resetpassword', [
                'model' => $model,
            ]);
        }            
    }
    
     // Función para el cambio de contraseña (mala)
    public function actionChangePassword()
    {
        $id = Yii::$app->user->id;
 
        try {
            $model = new PasswordForm($id);
        } catch (InvalidParamException $e) {
            throw new \yii\web\BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
            Yii::$app->session->setFlash('success', 'Contraseña cambiada con éxito.');
            return $this->redirect(['view', 'id' => $model->id]);
            
        }
 
        return $this->render('changePassword', [
            'model' => $model,
        ]);
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
