<?php

namespace App\Http\Controllers;

use App\Moto;
use App\Wypo;
use App\Marka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MotoController extends Controller
{
    public function viewMotoList()
    {

        $moto = Moto::all();
        $marka = Marka::all();

        return view('moto-list')
            ->with('moto', $moto)
            ->with('marka', $marka);
    }

    public function searchMotoList(Request $request)
    {
        $search_marka = $request->input('szukaj_marka');
        $search_model = $request->input('szukaj_model');

        $moto = Moto::orderBy('id','asc')
                    ->where('id_marka', 'like', $search_marka)
                    ->get();

        $marka = Marka::all();

        return view('moto-list')
            ->with('moto', $moto)
            ->with('marka', $marka);
    }

    public function dodajMoto(Request $request)
    {
		$moto = DB::select('select * from marka');

        return view('moto-dodaj')
            ->with('moto', $moto);
    }

    public function do_dodajMoto(Request $request)
    {
		$motor = new Moto;

		$file = $request->file('file');
        $filename = uniqid().$file->getClientOriginalName();
        $file->move('motor/zdjecia', $filename);

        $motor->id_marka = $request->input('marka');
        $motor->model = $request->input('model');
        $motor->pojemnosc = $request->input('pojemnosc');
        $motor->moc = $request->input('moc');
        $motor->waga = $request->input('waga');
        $motor->zdj = 'motor/zdjecia/' . $filename;
        $motor->dostep = '1';
        $motor->save();

        return redirect('/');
    }

    public function editMoto($id)
    {
        $moto = Moto::findOrFail($id);
        $marka = Marka::all();


        return view('moto-edit')
            ->with('moto', $moto)
            ->with('marka', $marka);
    }

    public function doEdit(Request $request, $id)
    {
        $motor = Moto::findOrFail($id);


        $motor->id_marka = $request->input('marka_edit');
        $motor->model = $request->input('model_edit');
        $motor->pojemnosc = $request->input('pojemnosc_edit');
        $motor->moc = $request->input('moc_edit');
        $motor->waga = $request->input('waga_edit');
        $motor->dostep = $request->input('dostep_edit');
        $motor->save();

        return redirect()->back();
    }

    public function doEditZdj(Request $request, $id)
    {
        $motor = Moto::findOrFail($id);

        $file = $request->file('file');

        $filename = uniqid().$file->getClientOriginalName();

        $file->move('motor/zdjecia', $filename);

        $motor->zdj = 'motor/zdjecia/' . $filename;
        $motor->save();

        return redirect()->back();
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

        if(Wypo::whereBetween('wypo_od', [($request->input('data_od')), ($request->input('data_do'))])
                ->orWhereBetween('wypo_do', [($request->input('data_od')), ($request->input('data_do'))])
                ->exists()){
            Session::flash('message', 'Motor jest już zarezerwowany na ten okres!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }else{

        $wypo = $motor->wypo()->create([
            'id_moto' => $request->input('id_moto'),
            'id_user' => $user,
            'wypo_od' => $request->input('data_od'),
            'wypo_do' => $request->input('data_do'),
            'aktywne' => 1,
        ]);
    }

        //DB::table('moto')->where('id', $request->input('id_moto'))->update(['dostep' => '0']);

        return redirect('/');
    }

    public function serviceMoto($id)
    {
        $moto = Moto::findOrFail($id);

        return view('moto-service')
            ->with('moto', $moto);
    }

    public function doServiceMoto(Request $request)
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

        //DB::table('moto')->where('id', $request->input('id_moto'))->update(['dostep' => '0']);

        return redirect('/');
    }

    public function deleteMoto($id)
    {
        $moto = Moto::findOrFail($id);

        $moto->delete();
        return redirect()->back();
    }


}
