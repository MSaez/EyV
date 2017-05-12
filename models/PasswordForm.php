<?php 
    namespace app\models;
    
    use Yii;
    use yii\base\Model;
    use app\models\Usuario;
    
    class PasswordForm extends Model{
        public $oldpass;
        public $newpass;
        public $repeatnewpass;
        
        public function rules(){
            return [
                [['oldpass','newpass','repeatnewpass'],'required'],
                ['oldpass','findPasswords'],
                ['repeatnewpass','compare','compareAttribute'=>'newpass'],
            ];
        }
        
        public function findPasswords($attribute, $params){
            $user = Usuario::find()->where([
                'US_USERNAME'=>Yii::$app->user->identity->US_USERNAME
            ])->one();
            $password = $user->US_PASSWORD;
            if($password!=$this->oldpass)
                $this->addError($attribute,'Contraseña actual erronea.');
        }
        
        public function attributeLabels(){
            return [
                'oldpass'=>'Contraseña Actual',
                'newpass'=>'Nueva Contraseña',
                'repeatnewpass'=>'Repetir Nueva Contraseña',
            ];
        }
    }
