<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cobros".
 *
 * @property integer $CBR_ID
 * @property integer $OT_ID
 * @property integer $CBR_VALOR
 * @property string $CBR_FECHA
 *
 * @property Ot $oT
 * @property Ot[] $ots
 */
class Cobros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cobros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID', 'CBR_VALOR'], 'integer'],
            [['CBR_VALOR'], 'required'],
            [['CBR_FECHA'], 'safe'],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Ot::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CBR_ID' => 'Cbr  ID',
            'OT_ID' => 'Ot  ID',
            'CBR_VALOR' => 'Cbr  Valor',
            'CBR_FECHA' => 'Cbr  Fecha',
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
        return $this->hasMany(Ot::className(), ['CBR_ID' => 'CBR_ID']);
    }
}
