<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $table = 'moto';

    protected $fillable = ['marka', 'model', 'pojemnosc', 'moc', 'waga', 'zdj', 'dostep'];

    public function wypo()
	{
    	return $this->hasMany('App\Wypo', 'id_moto');
	}
}
