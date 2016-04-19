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
            [['OT_ID', 'PAG_ID', 'INS_CANTIDAD', 'INS_PRECIO_UNITARIO', 'INS_TOTAL'], 'integer'],
            [['INS_NOMBRE', 'INS_CANTIDAD', 'INS_PRECIO_UNITARIO', 'INS_TOTAL'], 'required'],
            [['INS_NOMBRE'], 'string', 'max' => 128],
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
            'INS_ID' => 'Ins  ID',
            'OT_ID' => 'Ot  ID',
            'PAG_ID' => 'Pag  ID',
            'INS_NOMBRE' => 'Ins  Nombre',
            'INS_CANTIDAD' => 'Ins  Cantidad',
            'INS_PRECIO_UNITARIO' => 'Ins  Precio  Unitario',
            'INS_TOTAL' => 'Ins  Total',
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
}
