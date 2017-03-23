<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Leitura;
use App\Models\Placa;

class LeituraController extends Controller {

	public function __construct(){
	}

	public function getData($part_number){
		$device = Placa::where('part_number', '=', $part_number);
		return Leitura::where('placa_id', '=', $device->first()->id)->orderBy('horario_leitura', 'desc')->get();
	}
}