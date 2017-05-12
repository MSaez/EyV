<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insumo".
 *
 * @property int $INS_ID
 * @property int $OT_ID
 * @property int $PINS_ID
 * @property int $INV_ID
 * @property string $INS_NOMBRE
 * @property int $INS_CANTIDAD
 * @property int $INS_PRECIO_UNITARIO
 * @property int $INS_TOTAL
 * @property int $INS_RECIBIDO
 *
 * @property Inventario $iNV
 * @property PagoInsumos $pINS
 * @property Ot $oT
 * @property Inventario[] $inventarios
 * @property PagoInsumos[] $pagoInsumos
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
            [['OT_ID', 'PINS_ID', 'INV_ID', 'INS_CANTIDAD', 'INS_PRECIO_UNITARIO', 'INS_TOTAL', 'INS_RECIBIDO'], 'integer'],
            [['INS_NOMBRE', 'INS_CANTIDAD', 'INS_PRECIO_UNITARIO', 'INS_TOTAL'], 'required'],
            [['INS_NOMBRE'], 'string', 'max' => 128],
            [['INS_NOMBRE'], 'match', 'pattern' => '/^[\sa-zA-Z0-9áéíóúAÉÍÓÚÑñ.,:;-]+$/', 'message'=>'Nombre de Insumo Inválido. Por favor ingrese solo caracteres alfanuméricos y signos de puntuación.'],
            [['INV_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Inventario::className(), 'targetAttribute' => ['INV_ID' => 'INV_ID']],
            [['PINS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PagoInsumos::className(), 'targetAttribute' => ['PINS_ID' => 'PINS_ID']],
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
            'PINS_ID' => 'Documento de Pago',
            'INV_ID' => 'Insumo',
            'INS_NOMBRE' => 'Nombre',
            'INS_CANTIDAD' => 'Cantidad',
            'INS_PRECIO_UNITARIO' => 'Precio  Unitario',
            'INS_TOTAL' => 'Total',
            'INS_RECIBIDO' => 'Recibido',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINV()
    {
        return $this->hasOne(Inventario::className(), ['INV_ID' => 'INV_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPINS()
    {
        return $this->hasOne(PagoInsumos::className(), ['PINS_ID' => 'PINS_ID']);
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
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['INS_ID' => 'INS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagoInsumos()
    {
        return $this->hasMany(PagoInsumos::className(), ['INS_ID' => 'INS_ID']);
    }
}
