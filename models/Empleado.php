<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleado".
 *
 * @property string $EMP_RUT
 * @property string $EMP_NOMBRES
 * @property string $EMP_PATERNO
 * @property string $EMP_MATERNO
 *
 * @property ActividadDesabolladura[] $actividadDesabolladuras
 * @property ActividadPintura[] $actividadPinturas
 */
class Empleado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empleado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMP_RUT', 'EMP_NOMBRES', 'EMP_PATERNO', 'EMP_MATERNO'], 'required'],
            [['EMP_RUT'], 'string', 'max' => 13],
            [['EMP_NOMBRES', 'EMP_PATERNO', 'EMP_MATERNO'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EMP_RUT' => 'Rut',
            'EMP_NOMBRES' => 'Nombres',
            'EMP_PATERNO' => 'Apellido Paterno',
            'EMP_MATERNO' => 'Apellido Materno',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadDesabolladuras()
    {
        return $this->hasMany(ActividadDesabolladura::className(), ['EMP_RUT' => 'EMP_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadPinturas()
    {
        return $this->hasMany(ActividadPintura::className(), ['EMP_RUT' => 'EMP_RUT']);
    }

    public function getNombreCompleto() // Función que obtiene el nombre completo de un registro en el modelo.
    {
        return $this->EMP_NOMBRES.' '.$this->EMP_PATERNO.' '.$this->EMP_MATERNO;
    }
}
