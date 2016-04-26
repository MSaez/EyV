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
 * @property Empleado $eMPRUT
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
            [['EMP_RUT'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['EMP_RUT' => 'EMP_RUT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PIN_ID' => 'ID',
            'EMP_RUT' => 'Empleado',
            'OT_ID' => 'Orden de Trabajo',
            'PIN_DESCRIPCION' => 'Descripción',
            'PIN_HORAS' => 'Horas',
            'PIN_PRECIO' => 'Precio',
            'PIN_ESTADO' => 'Estado',
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
        return $this->hasOne(Empleado::className(), ['EMP_RUT' => 'EMP_RUT']);
    }
}
