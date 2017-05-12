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
 * @property ResponsableDesabolladura[] $responsableDesabolladuras
 * @property ActividadDesabolladura[] $dESs
 * @property ResponsablePintura[] $responsablePinturas
 * @property ActividadPintura[] $pINs
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
            [['EMP_RUT'], 'string', 'min' => 11],
            [['EMP_RUT'], 'string', 'max' => 12],
            [['EMP_RUT'], \sateler\rut\RutValidator::className()],
            [['EMP_NOMBRES', 'EMP_PATERNO', 'EMP_MATERNO'], 'string', 'max' => 128],
            [['EMP_NOMBRES'], 'match', 'pattern' => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]+$/', 'message'=>'Nombre Inválido. Por favor ingrese solo caracteres alfabeticos.'],
            [['EMP_PATERNO'], 'match', 'pattern' => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]+$/', 'message'=>'Apellido Paterno Inválido. Por favor ingrese solo caracteres alfabeticos.'],
            [['EMP_MATERNO'], 'match', 'pattern' => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]+$/', 'message'=>'Apellido Materno Inválido. Por favor ingrese solo caracteres alfabeticos.'],
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
    public function getResponsableDesabolladuras()
    {
        return $this->hasMany(ResponsableDesabolladura::className(), ['EMP_RUT' => 'EMP_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDESABOLLADURAS()
    {
        return $this->hasMany(ActividadDesabolladura::className(), ['DES_ID' => 'DES_ID'])->viaTable('responsable_desabolladura', ['EMP_RUT' => 'EMP_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsablePinturas()
    {
        return $this->hasMany(ResponsablePintura::className(), ['EMP_RUT' => 'EMP_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPINTURAS()
    {
        return $this->hasMany(ActividadPintura::className(), ['PIN_ID' => 'PIN_ID'])->viaTable('responsable_pintura', ['EMP_RUT' => 'EMP_RUT']);
    }
    
    // Función que obtiene el nombre completo de un registro en el modelo.
    public function getNombreCompleto()             
    {
        return $this->EMP_NOMBRES.' '.$this->EMP_PATERNO.' '.$this->EMP_MATERNO;
    }
}
