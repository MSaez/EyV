<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $CLI_ID
 * @property string $CLI_NOMBRES
 * @property string $CLI_PATERNO
 * @property string $CLI_MATERNO
 * @property string $CLI_RUT
 * @property string $CLI_TELEFONO
 * @property string $CLI_DIRECCION
 *
 * @property Ot[] $ots
 * @property Vehiculo[] $vehiculos
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CLI_NOMBRES', 'CLI_PATERNO', 'CLI_MATERNO', 'CLI_RUT', 'CLI_TELEFONO', 'CLI_DIRECCION'], 'required'],
            [['CLI_DIRECCION'], 'string'],
            [['CLI_NOMBRES', 'CLI_PATERNO', 'CLI_MATERNO'], 'string', 'max' => 128],
            [['CLI_RUT'], 'string', 'min' => 11],
            [['CLI_RUT'], 'string', 'max' => 12],
            [['CLI_RUT'], \sateler\rut\RutValidator::className()],
            [['CLI_TELEFONO'], 'string', 'max' => 20],
            // Valida que no se ingresen caracteres especiales o numeros en los campos nombres, apellido paterno y apellido materno
            ['CLI_NOMBRES', 'match', 'pattern' => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]+$/', 'message'=>'Nombre Inválido. Por favor ingrese solo caracteres alfabeticos.'],
            ['CLI_PATERNO', 'match', 'pattern' => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ]+$/', 'message'=>'Apellido Paterno Inválido. Por favor ingrese solo caracteres alfabeticos.'],
            ['CLI_MATERNO', 'match', 'pattern' => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ]+$/', 'message'=>'Apellido Materno Inválido. Por favor ingrese solo caracteres alfabeticos.'],
            ['CLI_TELEFONO', 'match', 'pattern' => '/^[+0-9]+$/', 'message'=>'Número telefónico Inválido. Por favor ingrese solo caracteres numéricos.'],
            ['CLI_DIRECCION', 'match', 'pattern' => '/^[a-zA-Z0-9áéíóúAÉÍÓÚÑñ.,:;-]+$/', 'message'=>'Dirección Inválida. Por favor ingrese solo caracteres alfanuméricos y signos de puntuación.'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CLI_ID' => 'ID',
            'CLI_NOMBRES' => 'Nombres',
            'CLI_PATERNO' => 'Apellido Paterno',
            'CLI_MATERNO' => 'Apellido Materno',
            'CLI_RUT' => 'Rut',
            'CLI_TELEFONO' => 'Teléfono',
            'CLI_DIRECCION' => 'Dirección',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOts()
    {
        return $this->hasMany(Ot::className(), ['CLI_ID' => 'CLI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehiculos()
    {
        return $this->hasMany(Vehiculo::className(), ['CLI_ID' => 'CLI_ID']);
    }
    
    public function getNombreCompleto() // Función que obtiene el nombre completo de un registro en el modelo.
    {
        return $this->CLI_NOMBRES.' '.$this->CLI_PATERNO.' '.$this->CLI_MATERNO;
    }
}
