<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Piloto;
use App\Models\Nave;

class PilotoController extends Controller
{
    //
    public function crearPiloto(Request $request){

		$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			//TODO: validar los datos introducidos
			if(Nave::find($datos->nave)){
				//Crear el piloto
				$piloto = new Piloto();


				//Valores obligatorios
				$piloto->nombre = $datos->nombre;
				$piloto->fecha_nacimiento = $datos->fecha;
				$piloto->rango = $datos->rango;
				$piloto->numero = $datos->numero;

				
					$piloto->nave_id = $datos->nave;


				//Valores opcionales
				$piloto->planeta = (isset($datos->planeta) ? $datos->planeta : null);
				
				//Guardar el piloto
				try{

					$piloto->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}

			}else{
				$respuesta = "Identificador de nave incorrecto";
			}

		}else{
			$respuesta = "Datos incorrectos";
		}
		


		return response($respuesta);
	}

	public function modificarPiloto(Request $request,$id){

		$respuesta = "";

		//Buscar si existe la nave
		$piloto = Piloto::find($id);

		if($piloto){

			//Procesar los datos recibidos
			$datos = $request->getContent();

			//Verificar que hay datos
			$datos = json_decode($datos);

			if($datos){

				//TODO: validar los datos introducidos

				//Valores obligatorios
				if(isset($datos->nombre))
					$piloto->nombre = $datos->nombre;
				if(isset($datos->fecha))
					$piloto->fecha_nacimiento = $datos->fecha;
				if(isset($datos->planeta))
					$piloto->planeta = $datos->planeta;
				if(isset($datos->rango))
					$piloto->rango = $datos->rango;
				if(isset($datos->numero))
					$piloto->numero = $datos->numero;
				if(isset($datos->nave))
					$piloto->nave_id = $datos->nave;

				//Guardar el piloto
				try{

					$piloto->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}
			}else{
				$respuesta = "Datos incorrectos";
			}
		}else{
			$response = "No se ha encontrado el piloto";
		}


		return response($respuesta);
	}

	public function borrarPiloto(Request $request,$id){

		$respuesta = "";

		//Buscar si existe la nave
		$piloto = Piloto::find($id);

		if($piloto){

			//Borrar el piloto
			try{

				$piloto->delete();

				$respuesta = "OK";
			}catch(\Exception $e){
				$respuesta = $e->getMessage();
			}

		}else{
			$response = "No se ha encontrado el piloto";
		}


		return response($respuesta);
	}

	public function verPiloto($id){

		$piloto = Piloto::find($id);

		if($piloto){

			return response()->json(

				[
					"id" => $piloto->id,
					"nombre" => $piloto->nombre,
					"planeta" => $piloto->planeta,
					"rango" => $piloto->rango,
					"numero" => $piloto->numero,
					"nave_id" => $piloto->nave_id,
					"nave_modelo" => $piloto->nave->modelo,
					"fecha_nacimiento" => $piloto->fecha_nacimiento
				]

			);
		}

		return response("Piloto no encontrado");
	}
}
