<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventario".
 *
 * @property int $INV_ID
 * @property int $OT_ID
 * @property int $INS_ID
 * @property string $INV_NOMBRE
 * @property int $INV_CANTIDAD
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
        $max = $this->iNS->INS_CANTIDAD;
        return [
            [['OT_ID', 'INS_ID', 'INV_CANTIDAD'], 'integer'],
                [['INV_CANTIDAD'], 'compare', 'compareValue' => $max, 'operator' => '<='],
            [['INV_NOMBRE', 'INV_CANTIDAD'], 'required'],
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
}
