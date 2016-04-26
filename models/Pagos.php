<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagos".
 *
 * @property integer $PAG_ID
 * @property integer $OS_ID
 * @property integer $INS_ID
 * @property integer $PAG_VALOR
 * @property string $PAG_FECHA
 *
 * @property Insumo[] $insumos
 * @property OtrosServicios[] $otrosServicios
 * @property Insumo $iNS
 * @property OtrosServicios $oS
 */
class Pagos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OS_ID', 'INS_ID', 'PAG_VALOR'], 'integer'],
            [['PAG_VALOR'], 'required'],
            [['PAG_FECHA'], 'safe'],
            [['INS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Insumo::className(), 'targetAttribute' => ['INS_ID' => 'INS_ID']],
            [['OS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OtrosServicios::className(), 'targetAttribute' => ['OS_ID' => 'OS_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PAG_ID' => 'Pag  ID',
            'OS_ID' => 'Os  ID',
            'INS_ID' => 'Ins  ID',
            'PAG_VALOR' => 'Pag  Valor',
            'PAG_FECHA' => 'Pag  Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasMany(Insumo::className(), ['PAG_ID' => 'PAG_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtrosServicios()
    {
        return $this->hasMany(OtrosServicios::className(), ['PAG_ID' => 'PAG_ID']);
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
    public function getOS()
    {
        return $this->hasOne(OtrosServicios::className(), ['OS_ID' => 'OS_ID']);
    }
}
