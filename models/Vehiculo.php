<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehiculo".
 *
 * @property integer $VEH_ID
 * @property integer $MAR_ID
 * @property integer $MOD_ID
 * @property integer $CLI_ID
 * @property integer $VEH_ANIO
 * @property string $VEH_CHASIS
 * @property string $VEH_MOTOR
 * @property string $VEH_COLOR
 * @property string $VEH_PATENTE
 *
 * @property Ot[] $ots
 * @property Marca $mAR
 * @property Modelo $mOD
 * @property Cliente $cLI
 */
class Vehiculo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehiculo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MAR_ID', 'MOD_ID', 'CLI_ID', 'VEH_ANIO', 'VEH_CHASIS', 'VEH_MOTOR', 'VEH_COLOR', 'VEH_PATENTE'], 'required'],
            [['MAR_ID', 'MOD_ID', 'CLI_ID', 'VEH_ANIO'], 'integer'],
            [['VEH_CHASIS', 'VEH_MOTOR', 'VEH_COLOR'], 'string', 'max' => 128],
            [['VEH_PATENTE'], 'string', 'max' => 8],
            [['VEH_PATENTE'], 'unique'],
            [['MAR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['MAR_ID' => 'MAR_ID']],
            [['MOD_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['MOD_ID' => 'MOD_ID']],
            [['CLI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['CLI_ID' => 'CLI_ID']],
            [['VEH_CHASIS'], 'match', 'pattern' => '/^[A-Z0-9\-]+$/', 'message'=>'Número de Chasis Inválido. Por favor ingrese solo caracteres alfanuméricos(mayúsculas).'],
            [['VEH_MOTOR'], 'match', 'pattern' => '/^[A-Z0-9\-]+$/', 'message'=>'Número de Motor Inválido. Por favor ingrese solo caracteres alfanuméricos(mayúsculas).'],
            [['VEH_COLOR'], 'match', 'pattern' => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]+$/', 'message'=>'Color Inválido. Por favor ingrese solo caracteres alfabeticos.'],
            [['VEH_PATENTE'], 'match', 'pattern' => '/^[A-Z]{4}\d{2}$|[A-Z]{2}\d{4}$/', 'message'=>'Patente Inválida.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VEH_ID' => 'ID',
            'MAR_ID' => 'Marca',
            'MOD_ID' => 'Modelo',
            'CLI_ID' => 'Propietario',
            'VEH_ANIO' => 'Año',
            'VEH_CHASIS' => 'Número de Chasis',
            'VEH_MOTOR' => 'Número de Motor',
            'VEH_COLOR' => 'Color',
            'VEH_PATENTE' => 'Patente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOts()
    {
        return $this->hasMany(Ot::className(), ['VEH_ID' => 'VEH_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMAR()
    {
        return $this->hasOne(Marca::className(), ['MAR_ID' => 'MAR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMOD()
    {
        return $this->hasOne(Modelo::className(), ['MOD_ID' => 'MOD_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCLI()
    {
        return $this->hasOne(Cliente::className(), ['CLI_ID' => 'CLI_ID']);
    }
}
