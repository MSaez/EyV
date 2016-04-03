<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "usuario".
 *
 * @property integer $US_ID
 * @property string $US_USERNAME
 * @property string $US_RUT
 * @property string $US_NOMBRES
 * @property string $US_PATERNO
 * @property string $US_MATERNO
 * @property string $US_EMAIL
 * @property string $US_PASSWORD
 * @property string $US_AUTHKEY
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['US_USERNAME', 'US_RUT', 'US_NOMBRES', 'US_PATERNO', 'US_MATERNO', 'US_EMAIL', 'US_PASSWORD', 'US_AUTHKEY'], 'required'],
            ['US_USERNAME', 'unique'],
            ['US_RUT', 'unique'],
            ['US_EMAIL', 'unique'],
            [['US_USERNAME'], 'string', 'max' => 50],
            [['US_RUT'], 'string', 'max' => 12],
            [['US_RUT'], 'match', 'pattern' => "/^.{11,12}$/", 'message' => 'RUT no válido'],
            [['US_EMAIL'], 'email'],
            [['US_NOMBRES', 'US_PATERNO', 'US_MATERNO', 'US_EMAIL'], 'string', 'max' => 80],
            [['US_PASSWORD', 'US_AUTHKEY'], 'string', 'max' => 250],
            [['US_PASSWORD'], 'match', 'pattern' => "/^.{7,16}$/", 'message' => 'Mínimo 7 y máximo 16 caracteres'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'US_ID' => 'ID',
            'US_USERNAME' => 'Username',
            'US_RUT' => 'Rut',
            'US_NOMBRES' => 'Nombres',
            'US_PATERNO' => 'Paterno',
            'US_MATERNO' => 'Materno',
            'US_EMAIL' => 'Correo Electrónico',
            'US_PASSWORD' => 'Contraseña',
            'US_AUTHKEY' => 'Auth key',
            'US_CREADO' => 'Fecha creación',
            'US_ACTUALIZADO' => 'Fecha actualización'
        ];
    }
    
    // implementacion de los metodos necesarios para autentificación
    
    public static function findIdentity($id){
	return static::findOne($id);
    }
 
    public static function findIdentityByAccessToken($token, $type = null){
	throw new NotSupportedException();

    }
 
    public function getId(){
	return $this->US_ID;
    }
 
    public function getAuthKey(){
	return $this->US_AUTHKEY;
    }
 
    public function validateAuthKey($authKey){
	return $this->US_AUTHKEY === $authKey;
    }
    
    public static function findByUsername($username){
        return self::findOne(['US_USERNAME'=>$username]);
    }
 
    public function validatePassword($password){
	return $this->US_PASSWORD === $password;
    }
    
    public function behaviors() 
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['US_CREADO', 'US_ACTUALIZADO'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['US_ACTUALIZADO']
                ],
                'value' => new Expression('NOW()'),
            ],
        ]; 
    }
}
