<?php

namespace app\models;

use Yii;

use yii\base\Model;

class FormValidator extends Model
{

    public $nombre;

    public $email;

    public function rules()
    {

        return [

            ['nombre', 'required', 'message' => 'El nombre es requerido'],
            ['nombre', 'match', 'pattern' => "/^.{3,50)$/", 'message' => 'Debe ser de 3 a 50 caracteres'],
            ['nombre', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Solo letras y numeros'],
            ['email', 'required', 'message' => "El email es requerido"],
            ['email', 'email', 'message' => 'Email no válido']

        ];
    }

    public function attributeLabels()
    {

        return [

            'nombre' => 'Label de Nombre:',

            'email' => 'Label de Email:'

        ];
    }
}
