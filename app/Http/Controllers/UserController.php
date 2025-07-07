<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'cedula' => 'required',
            'fechaNacimiento' => 'required',
            'sexo' => 'required'
        ]);
        
        $userData = $request->all();

        $profile = new Profile(
          $userData['nombre'],
          $userData['cedula'],
          $userData['fechaNacimiento'],
          $userData['sexo'],
        );

        $user = $profile->getUser();

        return response()->json($user->toArray());
    }
}

class Profile {
    private User $user;

    public function __construct($nombre, $cedula, $fechaNacimiento, $sexo) {
        $this->user = new User($nombre, $cedula, $fechaNacimiento, $sexo);
    }

    function getUser() : User {
        return $this->user;
    }
}

class User {
    private $nombre;
    private $cedula;
    private $fechaNacimiento;
    private $sexo;

    public function __construct($nombre, $cedula, $fechaNacimiento, $sexo) {
        $this->nombre = $nombre;
        $this->cedula = $cedula;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->sexo = $sexo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function toArray() {
        return [
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'fechaNacimiento' => $this->fechaNacimiento,
            'sexo' => $this->sexo,
        ];
    }
}
