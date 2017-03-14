<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Models\Placa;

class LoginController extends Controller
{
    //
    public function login(){
        return view('authentication.login');
    }

    public function postLogin(Request $request){
        Sentinel::authenticate($request->all());
        //dd(Sentinel::check());
        if($user = Sentinel::check()){
           return $this->showLogin();
           //return redirect()->route('appindex.show');//->with('devices' => '  '); 
        }
        return $this->logout();
    }

    public function showLogin(){
        //dd(Placa::first());
        return redirect()->route('appindex.show')->withDevices([1, 2]);
    }

    public function logout(){
        Sentinel::logout();
        return redirect('/login');
    }
}
