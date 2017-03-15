<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "despacho".
 *
 * @property integer $OD_ID
 * @property integer $OT_ID
 * @property string $OD_FECHA
 * @property string $OD_OBSERVACINES
 *
 * @property Ot $oT
 * @property Ot[] $ots
 */
class Despacho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'despacho';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID'], 'integer'],
            [['OD_FECHA', 'OD_OBSERVACINES'], 'required'],
            [['OD_FECHA'], 'safe'],
            [['OD_OBSERVACINES'], 'string'],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Ot::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OD_ID' => 'Número de Orden',
            'OT_ID' => 'Código Orden de Trabajo',
            'OD_FECHA' => 'Fecha',
            'OD_OBSERVACINES' => 'Observacines',
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
    public function getOts()
    {
        return $this->hasMany(Ot::className(), ['OD_ID' => 'OD_ID']);
    }
}
