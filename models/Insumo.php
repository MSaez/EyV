<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insumo".
 *
 * @property integer $INS_ID
 * @property integer $OT_ID
 * @property integer $PAG_ID
 * @property string $INS_NOMBRE
 * @property integer $INS_CANTIDAD
 * @property integer $INS_PRECIO_UNITARIO
 * @property integer $INS_TOTAL
 * @property integer $INS_RECIBIDO 
 *
 * @property Pagos $pAG
 * @property Ot $oT
 * @property Pagos[] $pagos
 */
class Insumo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insumo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID', 'PAG_ID', 'INS_CANTIDAD', 'INS_PRECIO_UNITARIO', 'INS_TOTAL','INS_RECIBIDO'], 'integer'],
            [['INS_NOMBRE', 'INS_CANTIDAD', 'INS_PRECIO_UNITARIO', 'INS_TOTAL'], 'required'],
            [['INS_NOMBRE'], 'string', 'max' => 128],
            [['INS_NOMBRE'], 'match', 'pattern' => '/^[a-zA-Z0-9áéíóúAÉÍÓÚÑñ.,:;-]+$/', 'message'=>'Nombre de Insumo Inválido. Por favor ingrese solo caracteres alfanuméricos y signos de puntuación.'],
            [['PAG_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Pagos::className(), 'targetAttribute' => ['PAG_ID' => 'PAG_ID']],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Ot::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INS_ID' => 'ID',
            'OT_ID' => 'Orden de Trabajo',
            'PAG_ID' => 'Documento de Pago',
            'INS_NOMBRE' => 'Nombre',
            'INS_CANTIDAD' => 'Cantidad',
            'INS_PRECIO_UNITARIO' => 'Precio  Unitario',
            'INS_TOTAL' => 'Total',
            'INS_RECIBIDO' => 'Recibido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPAG()
    {
        return $this->hasOne(Pagos::className(), ['PAG_ID' => 'PAG_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOT()
    {
        return $this->hasOne(Ot::className(), ['OT_ID' => 'OT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::className(), ['INS_ID' => 'INS_ID']);
    }
    public function getRecibido()
    {
        if($this->INS_RECIBIDO == 0)
        {
            return "No";
        } 
        else
        {
            return "Sí";
        } 
    }
}
