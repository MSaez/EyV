<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago_externos".
 *
 * @property int $PEXT_ID
 * @property int $OS_ID
 * @property int $PEXT_FACTURA
 * @property int $PEXT_VALOR
 * @property string $PEXT_FECHA
 *
 * @property OtrosServicios[] $otrosServicios
 * @property OtrosServicios $oS
 */
class PagoExternos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pago_externos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OS_ID', 'PEXT_FACTURA', 'PEXT_VALOR'], 'integer'],
            [['PEXT_FACTURA', 'PEXT_VALOR', 'PEXT_FECHA'], 'required'],
            [['PEXT_FECHA'], 'safe'],
            [['OS_ID'], 'unique'],
            [['OS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OtrosServicios::className(), 'targetAttribute' => ['OS_ID' => 'OS_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PEXT_ID' => 'Id Pago',
            'OS_ID' => 'Código Servicio externo',
            'PEXT_FACTURA' => 'Número de Factura',
            'PEXT_VALOR' => 'Valor a pagar',
            'PEXT_FECHA' => 'Fecha de pago',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtrosServicios()
    {
        return $this->hasMany(OtrosServicios::className(), ['PEXT_ID' => 'PEXT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOS()
    {
        return $this->hasOne(OtrosServicios::className(), ['OS_ID' => 'OS_ID']);
    }
}
