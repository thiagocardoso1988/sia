<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placa extends Model
{
	protected $fillable = ['part_number', 'alias', 'user_id'];
    //

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

}
