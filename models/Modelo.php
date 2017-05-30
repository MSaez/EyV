<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modelo".
 *
 * @property integer $MOD_ID
 * @property integer $MAR_ID
 * @property string $MOD_NOMBRE
 * @property string $MOD_VARIANTE
 *
 * @property Marca $mAR
 * @property Vehiculo[] $vehiculos
 */
class Modelo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modelo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MAR_ID', 'MOD_NOMBRE', 'MOD_VARIANTE'], 'required'],
            [['MAR_ID'], 'integer'],
            [['MOD_NOMBRE', 'MOD_VARIANTE'], 'string', 'max' => 128],
            [['MAR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['MAR_ID' => 'MAR_ID']],
            [['MOD_NOMBRE', 'MOD_VARIANTE'], 'match', 'pattern' => '/^[\sa-zA-Z0-9áéíóúAÉÍÓÚÑñ.]+$/', 'message'=>'Nombre de Modelo Inválido. Por favor ingrese solo caracteres alfanuméricos.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MOD_ID' => 'ID',
            'MAR_ID' => 'Marca',
            'MOD_NOMBRE' => 'Nombre',
            'MOD_VARIANTE' => 'Variante',
        ];
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
    public function getVehiculos()
    {
        return $this->hasMany(Vehiculo::className(), ['MOD_ID' => 'MOD_ID']);
    }
    
    public function getNombreModelo(){
        return $this->MOD_NOMBRE.' '.$this->MOD_VARIANTE;
    }
}
