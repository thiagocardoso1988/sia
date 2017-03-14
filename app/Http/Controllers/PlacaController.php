<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Validator;

use Sentinel;
use App\Models\Placa;

class PlacaController extends Controller {

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
        // mensagens
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
}