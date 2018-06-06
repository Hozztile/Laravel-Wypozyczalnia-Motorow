<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wypo_akcesoria extends Model
{
    protected $table = 'wypo_akcesoria';

    protected $fillable = ['id_wypo', 'id_akcesoria'];

    public function wypo()
	{
		return $this->belongsTo('App\Wypo', 'id_wypo');
	}

	public function akcesoria()
	{
    	return $this->belongsTo('App\Akcesoria', 'id_akcesoria');
	}



}