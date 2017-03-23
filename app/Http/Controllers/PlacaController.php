<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Validator;

use Sentinel;
use App\Models\User;
use App\Models\Placa;
use App\Models\Leitura;

class PlacaController extends Controller {

    /**
     * Construtor da classe
     */
    public function __construct(){
    }

    /**
     * Faz a persistência dos dados passados no banco
     * @param  Request $request Dados passados pelo formulário no request anterior
     * @return mixed            Retorna uma 
     */
    public function postDevices(Request $request){
        // define as regras de validação e as mensagens de retorno -----------
        // regras
        $rules = array(
            'part_number' => 'required|unique:placas',
            'alias'       => 'required|min:10|max:255',
        );
        // define as mensagens retornadas em caso de erro na validação -------
        $messages = array(
            'part_number.required' => 'O número de série é obrigatório.',
            'part_number.unique'   => 'O número de série deve ser único. O informado ja foi utilizado.',
            'alias.required'       => 'O Nome do dispositivo é obrigatório.',
            'alias.min'            => 'O número de caracteres no Nome do dispositivo não deve conter menos que :min caracteres.',
            'alias.max'            => 'O número de caracteres no Nome do dispositivo não deve conter mais que :max caracteres.',
        );
        // aplica a validação e confere seu sucesso --------------------------
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        // cria uma nova placa com os dados passados e direciona a view ------
        $placa = new Placa;
        $placa->fill($request->all());
        $placa->save();
        return redirect()->route('appdevices.show');
    }

    public function getHistory($placa=null){
        // obtém a placa de acordo com o usuário logado, e retorna os dados da
        // primeira placa encontrada
        foreach($this->getPlacas($placa) as $p){
            $data[] = $p->id;
        }
        if (count($data)){
            $leituras = Leitura::whereIn('placa_id', $data);
            // devolve o melhor tipo de paginação com base no dispositivo
            if (stripos($_SERVER['HTTP_USER_AGENT'], "mobile") !== false){
                $leituras = $leituras->simplePaginate();
            } else {    
                $leituras = $leituras->paginate();
            }
        }
        return view('app.history')->withPlacas($this->getPlacas())
                                  ->withActiveDevice($placa)
                                  ->withDados($leituras);
    }

    public function getPlacas($pn=null){
        $user = Sentinel::getUser();
        $placas = Placa::where('user_id', '=', $user->id);
        if($pn){
            $placas = $placas->where('part_number', '=', $pn);
        }
        return $placas->get();
    }
}