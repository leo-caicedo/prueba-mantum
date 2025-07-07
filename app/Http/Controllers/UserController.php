<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUsers(Request $request)
    {
        /**
         * Ejemplo de json
         * [
         * 	{
         * 		"nombre": "leo",
         * 		"cedula": "1234",
         * 		"fechaNacimiento": "2025-01-12",
         * 		"sexo": "m"
         * 	},
         * 		{
         * 		"nombre": "lau",
         * 		"cedula": "1234",
         * 		"fechaNacimiento": "2025-01-12",
         * 		"sexo": "f"
         * 	}
         * ]
         */
        $personasData = $request->all();

        if (empty($personasData)) {
            return response()->json(['error' => 'No data provided'], 400);
        }

        $result = [];

        foreach ($personasData as $persona) {
            $profile = new Profile(
              $persona['nombre'],
              $persona['cedula'],
              $persona['fechaNacimiento'],
              $persona['sexo'],
            );

            $result[] = $profile->getPersona()->toArray();
        }

        return response()->json($result);
    }
}

class Profile {
    private Persona $persona;

    public function __construct($nombre, $cedula, $fechaNacimiento, $sexo) {
        $this->persona = new Persona($nombre, $cedula, $fechaNacimiento, $sexo);
    }

    function getPersona() : Persona {
        return $this->persona;
    }
}

class Persona {
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
