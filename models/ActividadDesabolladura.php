<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividad_desabolladura".
 *
 * @property integer $DES_ID
 * @property integer $OT_ID
 * @property string $EMP_RUT
 * @property string $DES_DESCRIPCION
 * @property integer $DES_HORAS
 * @property integer $DES_PRECIO
 * @property string $DES_ESTADO
 *
 * @property Ot $oT
 * @property ResponsableDesabolladura[] $responsableDesabolladuras
 * @property Empleado[] $eMPRUTs
 */
class ActividadDesabolladura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad_desabolladura';
    }
    
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID', 'DES_HORAS', 'DES_PRECIO'], 'integer'],
            [['DES_DESCRIPCION', 'DES_HORAS', 'DES_PRECIO', 'DES_ESTADO'], 'required'],
            [['DES_DESCRIPCION'], 'string'],
            [['EMP_RUT'], 'string', 'max' => 13],
            [['DES_ESTADO'], 'string', 'max' => 20],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Ot::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DES_ID' => 'Des  ID',
            'OT_ID' => 'Ot  ID',
            'EMP_RUT' => 'Emp  Rut',
            'DES_DESCRIPCION' => 'Des  Descripcion',
            'DES_HORAS' => 'Des  Horas',
            'DES_PRECIO' => 'Des  Precio',
            'DES_ESTADO' => 'Des  Estado',
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
    public function getResponsableDesabolladuras()
    {
        return $this->hasMany(ResponsableDesabolladura::className(), ['DES_ID' => 'DES_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['EMP_RUT' => 'EMP_RUT'])->viaTable('responsable_desabolladura', ['DES_ID' => 'DES_ID']);
    }
}
