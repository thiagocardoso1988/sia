<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Models\User;
use App\Models\Placa;

class AppController extends Controller {

	public function __construct(){
		if(!Sentinel::check())
			return redirect('login')->with('error', 'É necessário estar logado para acessar a página.');
	}

	public function index(){
		// obtém as placas do usuário
		$placas = Placa::where('user_id', '=', Sentinel::getUser()->id)->get();
		// caso não tenha nenhuma placa, direciona para a view de dispositivos
		if ($placas->count()){
			return view('app.index')->withPlacas($placas);
		}
		$this->getDevices();
	}

	public function getDevices(){
		$placas = Placa::all();
		return view('app.devices')->withPlacas($placas);
	}

	public function getHistory() {
		$placas = Placa::all();
		return view('app.history')->withPlacas($placas);
	}
}