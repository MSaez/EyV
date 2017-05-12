<?php

namespace app\models;

use yii\base\Model;

class InformeUtilidadForm extends Model
{
    public $fecha;

    public function rules()
    {
        return [
            [['fecha'], 'required'],            
        ];   
    }
    
    
}
