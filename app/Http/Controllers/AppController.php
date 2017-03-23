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

    public function index(Request $request){
        $device = $request->device;
        return $this->showIndex($device);        
    }

    private function showIndex($device){
        // obtém as placas do usuário
        $placas = Placa::where('user_id', '=', Sentinel::getUser()->id)->get();
        $placa = $placas->first()->part_number;
        if ($device == null) {
            $device = $placa;
        }
        // obtém os dados de leitura da placa em questão
        $data = $this->getData($device)->take(10);
        //return [$device, $data];
        // caso não tenha nenhuma placa, direciona para a view de dispositivos
        if ($placas->count()){
            return view('app.index')->withPlacas($placas)
                                    ->withActiveDevice($device)
                                    ->withDados($data);
        }
        $this->getDevices();
    }

    public function getDevices(){
        $placas = Placa::all();
        return view('app.devices')->withPlacas($placas)
                                  ->withActiveDevice($placas->first()->part_number)
                                  ->withDados(null);
    }

    public function getHistory(Request $request) {
        $device = $request->device;
        return app('App\Http\Controllers\PlacaController')->getHistory($device);
    }

    private function getData($device){
        return app('App\Http\Controllers\LeituraController')->getData($device);
    }
}