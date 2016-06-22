<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "responsable_desabolladura".
 *
 * @property string $EMP_RUT
 * @property integer $DES_ID
 *
 * @property Empleado $eMPRUT
 * @property ActividadDesabolladura $dES
 */
class ResponsableDesabolladura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'responsable_desabolladura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMP_RUT', 'DES_ID'], 'required'],
            [['DES_ID'], 'integer'],
            [['EMP_RUT'], 'string', 'max' => 13],
            [['EMP_RUT'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['EMP_RUT' => 'EMP_RUT']],
            [['DES_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ActividadDesabolladura::className(), 'targetAttribute' => ['DES_ID' => 'DES_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EMP_RUT' => 'Emp  Rut',
            'DES_ID' => 'Des  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEMPRUT()
    {
        return $this->hasOne(Empleado::className(), ['EMP_RUT' => 'EMP_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDES()
    {
        return $this->hasOne(ActividadDesabolladura::className(), ['DES_ID' => 'DES_ID']);
    }
}
