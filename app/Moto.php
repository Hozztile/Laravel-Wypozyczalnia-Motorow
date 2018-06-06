<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $table = 'moto';

    protected $fillable = ['id_marka', 'model', 'pojemnosc', 'moc', 'waga', 'zdj', 'dostep' , 'cena', 'przebieg', 'data_kons'];

    public function wypo()
	{
    	return $this->hasMany('App\Wypo', 'id_moto');
	}

	public function marka()
	{
    	return $this->belongsTo('App\Marka', 'id_marka');
	}

}
