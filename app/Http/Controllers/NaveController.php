<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nave;

class NaveController extends Controller
{
    //

	public function crearNave(Request $request){

		$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){

			//Crear la nave
			$nave = new Nave();

			//TODO: validar los datos introducidos

			//Valores obligatorios
			$nave->modelo = $datos->modelo;
			$nave->fecha_fabricacion = $datos->fecha;
			$nave->fabricante = $datos->fabricante;
			$nave->tipo = $datos->tipo;

			//Valores opcionales
			$nave->version = (isset($datos->version) ? $datos->version : "");
			$nave->horas_vuelo = (isset($datos->horas) ? $datos->horas : 0);


			//Guardar la nave
			try{

				$nave->save();

				$respuesta = "OK";
			}catch(\Exception $e){
				$respuesta = $e->getMessage();
			}
		}else{
			$respuesta = "Datos incorrectos";
		}
		


		return response($respuesta);
	}

	public function modificarNave(Request $request,$id){

		$respuesta = "";

		//Buscar si existe la nave
		$nave = Nave::find($id);

		if($nave){

			//Procesar los datos recibidos
			$datos = $request->getContent();

			//Verificar que hay datos
			$datos = json_decode($datos);

			if($datos){

				//TODO: validar los datos introducidos

				//Valores obligatorios
				if(isset($datos->modelo))
					$nave->modelo = $datos->modelo;
				if(isset($datos->fecha))
					$nave->fecha_fabricacion = $datos->fecha;
				if(isset($datos->fabricante))
					$nave->fabricante = $datos->fabricante;
				if(isset($datos->tipo))
					$nave->tipo = $datos->tipo;
				if(isset($datos->version))
					$nave->version = $datos->version;
				if(isset($datos->horas))
					$nave->horas_vuelo = $datos->horas;

				//Guardar la nave
				try{

					$nave->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}
			}else{
				$respuesta = "Datos incorrectos";
			}
		}else{
			$response = "No se ha encontrado la nave";
		}


		return response($respuesta);
	}

	public function borrarNave(Request $request,$id){

		$respuesta = "";

		//Buscar si existe la nave
		$nave = Nave::find($id);

		if($nave){

			//Borrar la nave
			try{

				$nave->delete();

				$respuesta = "OK";
			}catch(\Exception $e){
				$respuesta = $e->getMessage();
			}

		}else{
			$response = "No se ha encontrado la nave";
		}


		return response($respuesta);
	}

	public function listarNaves(){

		$naves = Nave::all();

		$resultado = [];

		foreach ($naves as $nave) {
			
			$resultado[] = [

				"id" => $nave->id,
				"modelo" => $nave->modelo,
				"tipo" => $nave->tipo

			];

		}

		return response()->json($resultado);

	}

	public function verNave($id){

		$nave = Nave::find($id);

		if($nave){

			return response()->json(

				[
					"id" => $nave->id,
					"modelo" => $nave->modelo,
					"version" => $nave->version,
					"tipo" => $nave->tipo,
					"horas_vuelo" => $nave->horas_vuelo,
					"fabricante" => $nave->fabricante,
					"fecha_fabricacion" => $nave->fecha_fabricacion
				]

			);
		}

		return response("Nave no encontrada");
	}

	public function listarNavesFiltro(Request $request){

		$naveClass = Nave::class;

		if($request->request->get('tipo'))
			$naveClass = $naveClass::where('tipo',$request->request->get('tipo'));
		if($request->request->get('modelo'))
			$naveClass = $naveClass::where('modelo','like','%'.$request->request->get('modelo').'%');


		$naves = $naveClass->get();



		$resultado = [];

		foreach ($naves as $nave) {
			
			$resultado[] = [

				"id" => $nave->id,
				"modelo" => $nave->modelo,
				"tipo" => $nave->tipo

			];

		}

		return response()->json($resultado);

	}
}