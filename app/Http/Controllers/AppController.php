<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Models\Placa;

class AppController extends Controller {

	public function __construct(){
		if(!Sentinel::check())
			return redirect('login')->with('error', 'É necessário estar logado para acessar a página.');
	}

	public function index(){
		$devices = Placa::all();
		return view('app.index')->withDevices($devices);
	}

	public function getDevices(){
		$placas = Placa::all();
		return view('app.devices')->withPlacas($placas);
	}
}