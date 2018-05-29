<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marka extends Model
{
    protected $table = 'marka';

    protected $fillable = ['nazwa'];


	public function moto()
	{
    	return $this->hasMany('App\Moto', 'id');
	}


}