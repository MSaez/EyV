<?php
    namespace app\models;
    
    use Yii;
    use yii\base\Model;
    use app\models\Usuario;
    
    
    class ResetPassForm extends Model
    {
        public $email;
        
        private $usuario;
           
        public function rules()
        {
            return [
                [['email'], 'required'],
                [['email'], 'email'],                
            ];
        }
        
        public function attributeLabels(){
            return [
                'email'=>'Correo Electrónico',
            ];
        } 
        
        public function resetPassword($email, $password){
            $usuario = Usuario::findByEmail($email);
            $usuario->setPassword($password);
            return $usuario->save(false);
        }
        
    }

