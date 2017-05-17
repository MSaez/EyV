<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Insumo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
}
