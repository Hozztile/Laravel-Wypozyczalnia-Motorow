<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wypo extends Model
{
    protected $table = 'wypo';

    protected $fillable = ['id_moto', 'id_user', 'wypo_od', 'wypo_do', 'aktywne'];

    public function moto()
	{
		return $this->belongsTo('App\Moto', 'id_moto');
	}


	public function users()
	{
    return $this->belongsTo('App\User', 'id_user');
	}
}
