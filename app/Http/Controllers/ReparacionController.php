<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reparacion;
use App\Models\Nave;
use App\Models\Mecanico;

class ReparacionController extends Controller
{
    public function crearReparacion(Request $request){

		$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			//TODO: validar los datos introducidos
			if(Nave::find($datos->nave)&&Mecanico::find($datos->mecanico)){
				//Crear la reparación
				$reparacion = new Reparacion();


				//Valores obligatorios
				$reparacion->mecanico_id = $datos->mecanico;
				$reparacion->informe = $datos->informe;
				$reparacion->nave_id = $datos->nave;
				

								
				//Guardar la reparacion
				try{

					$reparacion->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}

			}else{
				$respuesta = "Identificador de nave o mecánico incorrecto";
			}

		}else{
			$respuesta = "Datos incorrectos";
		}
		


		return response($respuesta);
	}

	public function verReparacion($id){

		$reparacion = Reparacion::find($id);

		return response()->json([
			"nombre_mecanico" => $reparacion->mecanico->nombre,
			"apellidos_mecanico" => $reparacion->mecanico->apellidos,
			"codigo_mecanico" => $reparacion->mecanico->codigo,
			"modelo_nave" => $reparacion->nave->modelo,
			"version_nave" => $reparacion->nave->version,
			"informe" => $reparacion->informe,
			"fecha" => $reparacion->created_at
		]);

	}
}
