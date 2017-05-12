<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago_insumos".
 *
 * @property int $PINS_ID
 * @property int $INS_ID
 * @property int $PINS_FACTURA
 * @property int $PINS_VALOR
 * @property string $PINS_FECHA
 *
 * @property Insumo[] $insumos
 * @property Insumo $iNS
 */
class PagoInsumos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pago_insumos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INS_ID', 'PINS_FACTURA', 'PINS_VALOR'], 'integer'],
            [['INS_ID'], 'unique'],
            [['PINS_FACTURA', 'PINS_VALOR'], 'required'],
            [['PINS_FECHA'], 'safe'],
            [['INS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Insumo::className(), 'targetAttribute' => ['INS_ID' => 'INS_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PINS_ID' => 'Id Pago',
            'INS_ID' => 'Código Insumo',
            'PINS_FACTURA' => 'Número de Factura',
            'PINS_VALOR' => 'Valor a pagar',
            'PINS_FECHA' => 'Fecha de pago',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasMany(Insumo::className(), ['PINS_ID' => 'PINS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINS()
    {
        return $this->hasOne(Insumo::className(), ['INS_ID' => 'INS_ID']);
    }
}
