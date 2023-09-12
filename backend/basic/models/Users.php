<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $email
 * @property string|null $username
 * @property string|null $password
 * @property string|null $authkey
 * @property string|null $accestoken
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 30],
            [['username'], 'string', 'max' => 80],
            [['password', 'authkey', 'accestoken'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'authkey' => 'Authkey',
            'accestoken' => 'Accestoken',
        ];
    }
}
