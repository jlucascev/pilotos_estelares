<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mecanico;

class MecanicoController extends Controller
{
    public function crearMecanico(Request $request){

		$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			//TODO: validar los datos introducidos
			//Crear el mecanico
			$mecanico = new Mecanico();


			//Valores obligatorios
			$mecanico->nombre = $datos->nombre;
			$mecanico->apellidos = $datos->apellidos;
			$mecanico->fecha_nacimiento = $datos->fecha_nacimiento;
			$mecanico->fecha_contrato = $datos->fecha_contrato;
			$mecanico->salario = $datos->salario;
			$mecanico->codigo = $datos->codigo;			
			//Guardar el mecanico
			try{

				$mecanico->save();

				$respuesta = "OK";
			}catch(\Exception $e){
				$respuesta = $e->getMessage();
			}

		}else{
			$respuesta = "Datos incorrectos";
		}
		


		return response($respuesta);
	}

	public function modificarMecanico(Request $request,$id){

		$respuesta = "";

		//Buscar si existe el mecánico
		$mecanico = Mecanico::find($id);

		if($mecanico){

			//Procesar los datos recibidos
			$datos = $request->getContent();

			//Verificar que hay datos
			$datos = json_decode($datos);

			if($datos){

				//TODO: validar los datos introducidos

				//Valores obligatorios
				if(isset($datos->nombre))
					$mecanico->nombre = $datos->nombre;
				if(isset($datos->fecha_contrato))
					$mecanico->fecha_contrato = $datos->fecha_contrato;
				if(isset($datos->fecha_nacimiento))
					$mecanico->fecha_nacimiento = $datos->fecha_nacimiento;
				if(isset($datos->apellidos))
					$mecanico->apellidos = $datos->apellidos;
				if(isset($datos->codigo))
					$mecanico->codigo = $datos->codigo;
				if(isset($datos->salario))
					$mecanico->salario = $datos->salario;

				//Guardar el mecanico
				try{

					$mecanico->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}
			}else{
				$respuesta = "Datos incorrectos";
			}
		}else{
			$response = "No se ha encontrado el mecanico";
		}


		return response($respuesta);
	}

	public function borrarMecanico(Request $request,$id){

		$respuesta = "";

		//Buscar si existe la nave
		$mecanico = Mecanico::find($id);

		if($mecanico){

			//Borrar el mecanico
			try{

				$mecanico->delete();

				$respuesta = "OK";
			}catch(\Exception $e){
				$respuesta = $e->getMessage();
			}

		}else{
			$response = "No se ha encontrado el mecanico";
		}


		return response($respuesta);
	}

	public function verMecanico($parametro,$valor){

		if($parametro == "id")
			$mecanico = Mecanico::find($valor);
		else
			$mecanico = Mecanico::where('codigo',$valor)->first();

		if($mecanico){

			$reparaciones = [];

			foreach ($mecanico->reparaciones as $reparacion) {
				$reparaciones[] = [
					"id" => $reparacion->id,
					"fecha" => $reparacion->created_at,
					"informe" => $reparacion->informe,
					"nave_id" => $reparacion->nave_id,
					"nave_modelo" => $reparacion->nave->modelo
				];
			}

			$datosMecanico = [
					"id" => $mecanico->id,
					"nombre" => $mecanico->nombre,
					"apellidos" => $mecanico->apellidos,
					"codigo" => $mecanico->codigo,
					"salario" => $mecanico->salario,
					"fecha_contrato" => $mecanico->fecha_contrato,
					"fecha_nacimiento" => $mecanico->fecha_nacimiento,
					"reparaciones" => $reparaciones
				];

			return response()->json( $datosMecanico
			);
		}

		return response("mecanico no encontrada");
	}

	public function listarMecanicos(){

		$mecanicos = Mecanico::all();

		$resultado = [];

		foreach ($mecanicos as $mecanico) {
			
			$resultado[] = [

				"id" => $mecanico->id,
				"nombre" => $mecanico->nombre,
				"apellidos" => $mecanico->apellidos,
				"codigo" => $mecanico->codigo

			];

		}

		return response()->json($resultado);

	}
}
