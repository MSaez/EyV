<?php 
    namespace app\models;
    
    use Yii;
    use yii\base\Model;
    use app\models\Usuario;
    use yii\base\InvalidParamException;
    
    class PasswordForm extends Model
    {
        public $id;
        public $password;
        public $confirm_password;
        
        private $_user;
        
        public function __construct($id, $config = [])
        {
            $this->_user = Usuario::findIdentity($id);
        
            if (!$this->_user) {
                throw new InvalidParamException('No se puede encontrar al usuario.');
            }
        
            $this->id = $this->_user->id;
            parent::__construct($config);
        }
        
        public function rules()
        {
            return [
                [['password','confirm_password'], 'required'],
                [['password','confirm_password'], 'string', 'min' => 6],
                ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            ];
        }
        
        public function attributeLabels(){
            return [
                'password'=>'Nueva Contraseña',
                'confirm_password'=>'Repetir Nueva Contraseña',
            ];
        }
        
        public function changePassword()
        {
        $user = $this->_user;
        $user->setPassword($this->password);
 
        return $user->save(false);
        }      
    }
