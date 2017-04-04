<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Placa;
use App\Models\Leitura;

class TestDataController extends Controller
{
    public function index(){
        $placas = Placa::all();
        //return($placas);
        return view('testdata')->withPlacas($placas);
    }

    public function process(Request $request){;
        $rawdata = $request->all()['medidas_data']; 
        $data = json_decode($rawdata, true);
        foreach ($data as $d) {
            $this->insert($d);
        }
        return Leitura::all();
    }

    private function insert($data){
        // estrutura básica com os dados
        $entry = ['horario_leitura'   => \Carbon\Carbon::parse($data[1])->addHours($data[2])->addMinutes($data[3]), 
                  'valor_temperatura' => $data[4],
                  'valor_umidade'     => $data[5],
                  'placa_id'          => Placa::where('part_number', '=', $data[0])->first()->id];
        // cria a nova informação e salva no banco
        $info = new Leitura();
        $info->fill($entry);
        $info->save();
    }
}
