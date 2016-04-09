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
 * @property string $CLI_IND_CONDUCTA
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
            [['CLI_RUT'], 'string', 'max' => 12],
            [['CLI_TELEFONO'], 'string', 'max' => 20],
            [['CLI_IND_CONDUCTA'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CLI_ID' => 'Cli  ID',
            'CLI_NOMBRES' => 'Cli  Nombres',
            'CLI_PATERNO' => 'Cli  Paterno',
            'CLI_MATERNO' => 'Cli  Materno',
            'CLI_RUT' => 'Cli  Rut',
            'CLI_TELEFONO' => 'Cli  Telefono',
            'CLI_DIRECCION' => 'Cli  Direccion',
            'CLI_IND_CONDUCTA' => 'Cli  Ind  Conducta',
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
}
