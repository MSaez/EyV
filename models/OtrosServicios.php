<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "otros_servicios".
 *
 * @property int $OS_ID
 * @property int $OT_ID
 * @property int $PEXT_ID
 * @property string $OS_DESCRIPCION
 * @property int $OS_PRECIO
 *
 * @property Ot $oT
 * @property PagoExternos $pEXT
 * @property PagoExternos[] $pagoExternos
 */
class OtrosServicios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otros_servicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID', 'PEXT_ID', 'OS_PRECIO'], 'integer'],
            [['OS_DESCRIPCION', 'OS_PRECIO'], 'required'],
            [['OS_DESCRIPCION'], 'string'],
            [['OS_DESCRIPCION'], 'match', 'pattern' => '/^[\sa-zA-Z0-9áéíóúAÉÍÓÚÑñ.,:;-]+$/', 'message'=>'Descripción Inválida. Por favor ingrese solo caracteres alfanuméricos y signos de puntuación.'],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Ot::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
            [['PEXT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PagoExternos::className(), 'targetAttribute' => ['PEXT_ID' => 'PEXT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OS_ID' => 'ID',
            'OT_ID' => 'Orden de Trabajo',
            'PEXT_ID' => 'Documento de Pago',
            'OS_DESCRIPCION' => 'Descripción',
            'OS_PRECIO' => 'Precio',
        ];
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
    public function getPEXT()
    {
        return $this->hasOne(PagoExternos::className(), ['PEXT_ID' => 'PEXT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagoExternos()
    {
        return $this->hasMany(PagoExternos::className(), ['OS_ID' => 'OS_ID']);
    }
}
