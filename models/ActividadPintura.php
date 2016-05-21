<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividad_pintura".
 *
 * @property integer $PIN_ID
 * @property string $EMP_RUT
 * @property integer $OT_ID
 * @property string $PIN_DESCRIPCION
 * @property integer $PIN_HORAS
 * @property integer $PIN_PRECIO
 * @property string $PIN_ESTADO
 *
 * @property Ot $oT
 * @property ResponsablePintura[] $responsablePinturas
 * @property Empleado[] $eMPRUTs
 */
class ActividadPintura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad_pintura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID', 'PIN_HORAS', 'PIN_PRECIO'], 'integer'],
            [['PIN_DESCRIPCION', 'PIN_HORAS', 'PIN_PRECIO', 'PIN_ESTADO'], 'required'],
            [['PIN_DESCRIPCION'], 'string'],
            [['EMP_RUT'], 'string', 'max' => 13],
            [['PIN_ESTADO'], 'string', 'max' => 20],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Ot::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PIN_ID' => 'Pin  ID',
            'EMP_RUT' => 'Emp  Rut',
            'OT_ID' => 'Ot  ID',
            'PIN_DESCRIPCION' => 'Pin  Descripcion',
            'PIN_HORAS' => 'Pin  Horas',
            'PIN_PRECIO' => 'Pin  Precio',
            'PIN_ESTADO' => 'Pin  Estado',
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
    public function getEMPRUT()
    {
        return $this->hasMany(ResponsablePintura::className(), ['PIN_ID' => 'PIN_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['EMP_RUT' => 'EMP_RUT'])->viaTable('responsable_pintura', ['PIN_ID' => 'PIN_ID']);
    }
}
