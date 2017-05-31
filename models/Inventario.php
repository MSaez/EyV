<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "inventario".
 *
 * @property int $INV_ID
 * @property int $OT_ID
 * @property int $INS_ID
 * @property string $INV_NOMBRE
 * @property int $INV_CANTIDAD
 * @property int $INV_PRECIO_UNITARIO 
 * @property int $INV_TOTAL
 *
 * @property Insumo[] $insumos
 * @property Insumo $iNS
 * @property Ot $oT
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        try{
        $max = $this->iNS->INS_CANTIDAD;
        } catch (yii\base\ErrorException $e){
            $max = 0;
        }
        return [
            [['OT_ID', 'INS_ID', 'INV_CANTIDAD', 'INV_PRECIO_UNITARIO', 'INV_TOTAL'], 'integer'],
            [['INV_CANTIDAD'], 'compare', 'compareValue' => $max, 'operator' => '<='],
            [['INV_NOMBRE', 'INV_CANTIDAD', 'INV_PRECIO_UNITARIO', ], 'required'],
            [['INV_NOMBRE'], 'string', 'max' => 128],
            [['INS_ID'], 'unique'],
            [['INS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Insumo::className(), 'targetAttribute' => ['INS_ID' => 'INS_ID']],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Ot::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INV_ID' => 'ID',
            'OT_ID' => 'Folio OT',
            'INS_ID' => 'Código Insumo',
            'INV_NOMBRE' => 'Nombre Insumo',
            'INV_CANTIDAD' => 'Cantidad',
            'INV_PRECIO_UNITARIO' => 'Precio Unitario',
            'INV_TOTAL' => 'Precio Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasMany(Insumo::className(), ['INV_ID' => 'INV_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINS()
    {
        return $this->hasOne(Insumo::className(), ['INS_ID' => 'INS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOT()
    {
        return $this->hasOne(Ot::className(), ['OT_ID' => 'OT_ID']);
    }
    
    public function getItemCantidad(){
        return $this->INV_NOMBRE.': Cantidad: '.$this->INV_CANTIDAD;
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'INV_TOTAL',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'INV_TOTAL',
                ],
                'value' => function ($event) {
                    return ($this->INV_CANTIDAD * $this->INV_PRECIO_UNITARIO);
                },
            ],
        ];
    }   
}
