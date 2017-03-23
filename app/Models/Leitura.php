<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
	protected $fillable = ['horario_leitura', 'valor_temperatura', 'valor_umidade', 'placa_id'];
}
