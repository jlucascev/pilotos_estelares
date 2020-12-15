<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function register(Request $request){
    	$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			//TODO: validar los datos introducidos
		
			//Crear el usuario
			$user = new User();


			//Valores obligatorios
			$user->email = $datos->email;
			$user->password = Hash::make($datos->password);
						
			//Guardar el user
			try{

				$user->save();

				$respuesta = "OK";
			}catch(\Exception $e){
				$respuesta = $e->getMessage();
			}

		}else{
			$respuesta = "Datos incorrectos";
		}
		


		return response($respuesta);
    }

    public function login(Request $request){
    	$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			
			if(isset($datos->email)&&isset($datos->password)){

				$user = User::where("email",$datos->email)->first();

				if($user){

					if(Hash::check($datos->password, $user->password)){

						$token = md5($user->email.now());

						$user->api_token = $token;

						$user->save();

						$respuesta = $token;

					}else{
						$respuesta = "Contraseña incorrecta";
					}

				}else{
					$respuesta = "Usuario no encontrado";
				}

			}else{
				$respuesta = "Faltan datos";
			}

		}else{
			$respuesta = "Datos incorrectos";
		}
		


		return response($respuesta);
    }
}
