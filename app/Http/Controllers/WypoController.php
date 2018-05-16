<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wypo;
use Illuminate\Support\Facades\DB;

class WypoController extends Controller
{
     public function viewWypoList()
    {

        $wypo = Wypo::all();

        return view('wypo-list')
            ->with('wypo', $wypo);
    }

    public function resWypo($id)
    {
        $wypo = Wypo::findOrFail($id);

        $id_motor = $wypo->moto['id'];

        DB::table('wypo')->where('id', $id)->update(['aktywne' => '0']);
        DB::table('moto')->where('id', $id_motor)->update(['dostep' => '1']);


        return redirect()->back();
    }
}
