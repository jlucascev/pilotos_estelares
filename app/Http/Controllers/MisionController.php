<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nave;
use App\Models\Piloto;
use App\Models\Mision;

class MisionController extends Controller
{
    //
    public function crearMision(Request $request){

		$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			//TODO: validar los datos introducidos
			if(Nave::find($datos->nave)&&Piloto::find($datos->piloto)){
				//Crear el piloto
				$mision = new Mision();


				//Valores obligatorios
				$mision->piloto_id = $datos->piloto;
				$mision->horas = $datos->horas;
				$mision->nave_id = $datos->nave;
				

				//Valores opcionales
				if($datos->derribos)
					$mision->derribos = $datos->derribos;
				$mision->informe = (isset($datos->informe) ? $datos->informe : null);
				
				//Guardar la mision
				try{

					$mision->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}

			}else{
				$respuesta = "Identificador de nave o piloto incorrecto";
			}

		}else{
			$respuesta = "Datos incorrectos";
		}
		


		return response($respuesta);
	}

	public function verMision($id){

		$mision = Mision::find($id);

		return response()->json([
			"piloto" => $mision->piloto->numero,
			"nave" => $mision->nave->modelo,
			"informe" => $mision->informe
		]);

	}
}
