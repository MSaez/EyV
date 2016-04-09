<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marca".
 *
 * @property integer $MAR_ID
 * @property string $MAR_NOMBRE
 *
 * @property Modelo[] $modelos
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MAR_NOMBRE'], 'required'],
            [['MAR_NOMBRE'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MAR_ID' => 'ID',
            'MAR_NOMBRE' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelos()
    {
        return $this->hasMany(Modelo::className(), ['MAR_ID' => 'MAR_ID']);
    }

    public function getNombreMarca()
    {
        return $this->MAR_NOMBRE;
    }
}
