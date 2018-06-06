<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akcesoria extends Model
{
    protected $table = 'akcesoria';

    protected $fillable = ['nazwa'];

    public function wypo()
	{
		return $this->belongsTo('App\Wypo', 'id_wypo');
	}

	public function wypo_akcesoria()
	{
    	return $this->hasMany('App\Wypo_akcesoria', 'id');
	}



}