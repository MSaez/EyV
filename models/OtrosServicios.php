<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "otros_servicios".
 *
 * @property integer $OS_ID
 * @property integer $OT_ID
 * @property integer $PAG_ID
 * @property string $OS_DESCRIPCION
 * @property integer $OS_PRECIO
 *
 * @property Ot $oT
 * @property Pagos $pAG
 * @property Pagos[] $pagos
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
            [['OT_ID', 'PAG_ID', 'OS_PRECIO'], 'integer'],
            [['OS_DESCRIPCION', 'OS_PRECIO'], 'required'],
            [['OS_DESCRIPCION'], 'string'],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Ot::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
            [['PAG_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Pagos::className(), 'targetAttribute' => ['PAG_ID' => 'PAG_ID']],
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
            'PAG_ID' => 'Documento de Pago',
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
    public function getPAG()
    {
        return $this->hasOne(Pagos::className(), ['PAG_ID' => 'PAG_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::className(), ['OS_ID' => 'OS_ID']);
    }
}
