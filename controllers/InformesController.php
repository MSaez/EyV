<?php

namespace app\controllers;

use yii;
use app\models\InformeUtilidadForm;
use app\models\OtAtrasadosSearch;
use app\models\Ot;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use app\models\Usuario;

class InformesController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['generarInformeAtrasados', 'generarInformeUtilidad', 'imprimirAtrasos', 'imprimirUtilidad'],
                'rules' => [
                    //Para Administrador
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['generarInformeAtrasados', 'generarInformeUtilidad', 'imprimirAtrasos', 'imprimirUtilidad'],
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
                ],
            ],
        ];
    }
    
    public function actionGenerarInformeAtrasados()
    {
        $searchModelOt = new OtAtrasadosSearch();
        $dataProviderAtrasos = $searchModelOt->search(Yii::$app->request->queryParams);
        $hoy = date("d-m-Y");
        return $this->render('ver_atrasos', [           
            'searchModelOt' => $searchModelOt,
            'dataProviderAtrasos' => $dataProviderAtrasos,
        ]);
    }
    
    public function actionImprimirAtrasos()
    {
        $searchModelOt = new OtAtrasadosSearch();
        $dataProviderAtrasos = $searchModelOt->search(Yii::$app->request->queryParams);
        $hoy = date("d-m-Y");
        $content = $this->renderPartial('imprimir_atrasos',[            
            'searchModelOt' => $searchModelOt,
            'dataProviderAtrasos' => $dataProviderAtrasos,
        ]);
        $pdf = new Pdf([            
            'mode' => Pdf::MODE_CORE,             
            'format' => Pdf::FORMAT_A4,             
            'orientation' => Pdf::ORIENT_PORTRAIT,             
            'destination' => Pdf::DEST_DOWNLOAD,           
            'filename' => 'Informe_Atrasos_'.$hoy.'.pdf',           
            'content' => $content,             
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',            
            'cssInline' => '.kv-heading-1{font-size:18px}',            
            'options' => ['title' => 'Trabajos atrasados a fecha: '.$hoy],            
            'methods' => [ 
                //'SetHeader'=>['Krajee Report Header'], 
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        return $pdf->render(); 
    }

    public function actionGenerarInformeUtilidad()
    {
        $model = new InformeUtilidadForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $xfecha = explode("-",$model->fecha);
            $inicio = '"'.$xfecha[0].'-'.$xfecha[1].'-01"';
            $fin = '"'.$xfecha[0].'-'.$xfecha[1].'-31"';
            $sql = "SELECT ot.OT_ID, ot.CLI_ID, ot.VEH_ID, ot.OT_TOTAL, ot.OT_TDESABOLLADURA, ot.OT_TPINTURA, ot.OT_TINSUMO, ot.OT_TEXTERNO,ot.OT_SUBTOTAL, ot.OT_IVA, ot.OT_OBSERVACIONES FROM ot INNER JOIN cobros ON ot.OT_ID = cobros.OT_ID WHERE (cobros.CBR_FECHA BETWEEN ".$inicio." AND ".$fin.")";
            $query = Ot::findBySql($sql);
            
            $dataProviderUtilidad = new ActiveDataProvider([
                'query' => $query,
                'sort' => false,
            ]);
            
            $utilidad = 0;
        $total = 0;
        $subtotal = 0;
        $desabolladura = 0;
        $pintura = 0;
        $insumos =0;
        $externos = 0;
        $iva = 0;
        foreach ($dataProviderUtilidad->models as $item){
            $utilidad = $utilidad + $item->utilidad;
            $desabolladura = $desabolladura + $item->OT_TDESABOLLADURA;
            $pintura = $pintura + $item->OT_TPINTURA;
            $insumos = $insumos + $item->OT_TINSUMO;
            $externos = $externos + $item->OT_TEXTERNO;
            $subtotal = $subtotal + $item->OT_SUBTOTAL;
            $iva = $iva + $item->OT_IVA;
            $total = $total + $item->OT_TOTAL;
        }
            
            return $this->render('ver-utilidad', ['dataProviderUtilidad' => $dataProviderUtilidad,
                                                                'inicio' => $inicio,
                                                                'fin' => $fin,
                                                                'utilidad' => $utilidad,
                                                                'desabolladura' => $desabolladura,
                                                                'pintura' => $pintura,
                                                                'insumos' => $insumos,
                                                                'externos' => $externos,
                                                                'subtotal' => $subtotal,
                                                                'iva' => $iva,
                                                                'total' => $total
            ]);

            
        } else {
            return $this->render('generar-informe', ['model' => $model]);
        }
    }
    
    public function actionImprimirUtilidad($inicio, $fin)
    {
        $sql = "SELECT ot.OT_ID, ot.CLI_ID, ot.VEH_ID, ot.OT_TOTAL, ot.OT_TDESABOLLADURA, ot.OT_TPINTURA, ot.OT_TINSUMO, ot.OT_TEXTERNO,ot.OT_SUBTOTAL, ot.OT_IVA, ot.OT_OBSERVACIONES, cobros.CBR_VALOR, cobros.CBR_FECHA FROM ot INNER JOIN cobros ON ot.OT_ID = cobros.OT_ID WHERE (cobros.CBR_FECHA BETWEEN ".$inicio." AND ".$fin.")";
            $query = Ot::findBySql($sql);
            
        $dataProviderUtilidad = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);
        
        $utilidad = 0;
        $total = 0;
        $subtotal = 0;
        $desabolladura = 0;
        $pintura = 0;
        $insumos =0;
        $externos = 0;
        $iva = 0;
        foreach ($dataProviderUtilidad->models as $item){
            $utilidad = $utilidad + $item->utilidad;
            $desabolladura = $desabolladura + $item->OT_TDESABOLLADURA;
            $pintura = $pintura + $item->OT_TPINTURA;
            $insumos = $insumos + $item->OT_TINSUMO;
            $externos = $externos + $item->OT_TEXTERNO;
            $subtotal = $subtotal + $item->OT_SUBTOTAL;
            $iva = $iva + $item->OT_IVA;
            $total = $total + $item->OT_TOTAL;
        }
        
        $content = $this->renderPartial('imprimir_utilidad',[            
            'dataProviderUtilidad' => $dataProviderUtilidad,
            'utilidad' => $utilidad,
            'desabolladura' => $desabolladura,
            'pintura' => $pintura,
            'insumos' => $insumos,
            'externos' => $externos,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total
        ]);
        
        
        $hoy = date("d-m-Y");
        $pdf = new Pdf([            
            'mode' => Pdf::MODE_CORE,             
            'format' => Pdf::FORMAT_A4,             
            'orientation' => Pdf::ORIENT_LANDSCAPE,             
            'destination' => Pdf::DEST_DOWNLOAD,           
            'filename' => 'Informe_Utilidad_'.$hoy.'.pdf',           
            'content' => $content,             
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',            
            'cssInline' => '.kv-heading-1{font-size:18px}',            
            'options' => ['title' => 'Informe de Utilidad Mensual'],            
            'methods' => [ 
                //'SetHeader'=>['Krajee Report Header'], 
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

}
