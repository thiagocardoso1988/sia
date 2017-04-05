<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Leitura;
use App\Models\Placa;

class LeituraController extends Controller {

	public function __construct(){
		//\Carbon\Carbon::setLocale('America/Sao_Paulo');
	}

	public function getData($part_number){
		$device = Placa::where('part_number', '=', $part_number);
		return Leitura::where('placa_id', '=', $device->first()->id)->orderBy('horario_leitura', 'desc')->get();
	}

	public function store(Request $request) {
		$placa = Placa::where('part_number', '=', $request['id'])->first();
		$leitura = new Leitura();
		$leitura->horario_leitura = \Carbon\Carbon::now('America/Sao_Paulo');
		$leitura->valor_temperatura = $request['temperatura'];
		$leitura->valor_umidade = $request['umidade'];
		$leitura->placa_id = $placa->id;
		$leitura->save();
		return response('Saved data', 200);
	}
}