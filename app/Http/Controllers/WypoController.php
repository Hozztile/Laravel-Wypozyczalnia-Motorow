<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wypo;
use App\Moto;
use Illuminate\Support\Facades\DB;

class WypoController extends Controller
{
     public function viewWypoList()
    {

        $wypo = Wypo::all();
        $moto = Moto::all();

        return view('wypo-list')
            ->with('moto', $moto)
            ->with('wypo', $wypo);
    }

    public function resWypo($id)
    {
        $wypo = Wypo::findOrFail($id);

        $id_motor = $wypo->moto['id'];

        
        DB::table('moto')->where('id', $id_motor)->update(['dostep' => '1']);

        $wypo->delete();
        return redirect()->back();
    }

    public function viewWypoListUser($id)
    {

        $wypo = Wypo::where('id_user', $id)->get();
        $moto = Moto::all();

        return view('wypo-list-user')
            ->with('moto', $moto)
            ->with('wypo', $wypo);
    }
}
