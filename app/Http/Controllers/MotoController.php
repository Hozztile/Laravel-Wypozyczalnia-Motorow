<?php

namespace App\Http\Controllers;

use App\Moto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MotoController extends Controller
{
    public function viewMotoList()
    {

        $moto = Moto::all();
        return view('moto-list')
            ->with('moto', $moto);
    }

    public function dodajMoto(Request $request)
    {
		$moto = Moto::all();
        return view('moto-dodaj')
            ->with('moto', $moto);
    }

    public function do_dodajMoto(Request $request)
    {
		$motor = new Moto;

		$file = $request->file('file');
        $filename = uniqid().$file->getClientOriginalName();
        $file->move('/motor/zdjecia', $filename);

        $motor->marka = $request->input('marka');
        $motor->model = $request->input('model');
        $motor->pojemnosc = $request->input('pojemnosc'). ' cm3';
        $motor->moc = $request->input('moc') . ' KM';
        $motor->waga = $request->input('waga') . ' kg';
        $motor->zdj = 'motor/zdjecia/' . $filename;
        $motor->dostep = '1';
        $motor->save();

        return redirect()->back();
    }

    public function editMoto($id)
    {
        $moto = Moto::findOrFail($id);


        return view('moto-edit')
            ->with('moto', $moto);
    }

     public function loanMoto($id)
    {
        $moto = Moto::findOrFail($id);

        return view('moto-loan')
            ->with('moto', $moto);
    }

    public function doLoanMoto(Request $request)
    {
        $motor = Moto::findOrFail($request->input('id_moto'));
        $user = Auth::user()->id; 

        

        $wypo = $motor->wypo()->create([
            'id_moto' => $request->input('id_moto'),
            'id_user' => $user,
            'wypo_od' => $request->input('data_od'),
            'wypo_do' => $request->input('data_do'),
            'aktywne' => 1,
        ]);

        DB::table('moto')->where('id', $request->input('id_moto'))->update(['dostep' => '0']);

        return redirect()->back();
    }

}
