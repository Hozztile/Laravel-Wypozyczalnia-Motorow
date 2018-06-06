<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wypo extends Model
{
    protected $table = 'wypo';

    protected $fillable = ['id_moto', 'id_user', 'wypo_od', 'wypo_do', 'lok_z', 'lok_do', 'aktywne', 'cena_c'];

    public function moto()
	{
		return $this->belongsTo('App\Moto', 'id_moto');
	}

	public function wypo_akcesoria()
	{
    	return $this->hasMany('App\Wypo_akcesoria', 'id_wypo');
	}


	public function users()
	{
    return $this->belongsTo('App\User', 'id_user');
	}
}
