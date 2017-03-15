<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser;


class User extends EloquentUser
{

    protected $table = 'users';
/*    public function test() {
        return 'test';
    }
*/
   public function placas() {
       return $this->hasMany('App\Models\Placa');
   }
}