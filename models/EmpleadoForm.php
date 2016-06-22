<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EmpleadoForm extends Model
{
    public $EMP_RUT;
    

    public function rules()
    {
        return [
            ['EMP_RUT', 'required'],
        ];
    }
    
     public function attributeLabels()
    {
        return ['EMP_RUT' => 'Empleado'];
    }
            
}

