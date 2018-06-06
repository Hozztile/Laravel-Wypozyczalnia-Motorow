<?php

namespace App\Http\Controllers;

use App\Moto;
use App\Wypo;
use App\Marka;
use App\Akcesoria;
use App\Wypo_akcesoria;
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
        $search_pojemnosc = $request->input('szukaj_poj');
        $search_moc = $request->input('szukaj_moc');
        $search_waga = $request->input('szukaj_waga');
        $marka = Marka::all();

        

        $moto = Moto::orderBy('id','asc')
                    ->orWhere('id_marka', (is_null($search_marka) ? 'IS' : 'like') , $search_marka)
                    ->orWhere('model', (is_null($search_model) ? 'IS' : 'like') , '%'.$search_model.'%')
                    ->orWhere('pojemnosc', (is_null($search_pojemnosc) ? 'IS' : '>=') , $search_pojemnosc)
                    ->orWhere('moc', (is_null($search_moc) ? 'IS' : '>=') , $search_moc)
                    ->orWhere('waga', (is_null($search_waga) ? 'IS' : '>=') , $search_waga)
                    ->get();

        
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
        $motor->cena = $request->input('cena');
        $motor->przebieg = $request->input('przebieg');
        $motor->data_kons = 0000-00-00;
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
        $motor->cena = $request->input('cena_edit');
        $motor->przebieg = $request->input('przebieg_edit');
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
        $eq = Akcesoria::all();



        return view('moto-loan')
            ->with('moto', $moto)
            ->with('eq', $eq);
    }

    public function doLoanMoto(Request $request)
    {
        $motor = Moto::findOrFail($request->input('id_moto'));
        $user = Auth::user()->id;


        if($request->input('data_do') < $request->input('data_od')){
            Session::flash('message', 'Niepoprawne daty!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        } else{

        if(Wypo::where('id_moto', '=', $request->input('id_moto'))
                ->where(function($query) use ( $spr_data_od, $spr_data_do )
                {
                    $query->WhereBetween('wypo_od', [ $spr_data_od, $spr_data_do])
                         ->orWhereBetween('wypo_do', [ $spr_data_od, $spr_data_do]);
                })
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
            'lok_z' => $request->input('lok_z'),
            'lok_do' => $request->input('lok_do'),
            'aktywne' => 1,
            'cena_c' => 0,
        ]);

        $wypo->save();



        $ch = $request->input('check_list_dodatki');
        if(!empty($ch)){
        $ch_count = count($ch);

        $dodatki = [];
        
        foreach ($ch as $value) {
            $dodatki[] = [
            'id_wypo' => $wypo->id,
            'id_akcesoria' => $value
        ];
            }

            Wypo_akcesoria::insert($dodatki);
        }else {
        $ch_count=0;
        }
        
        

        $cena_dodatki = $ch_count * 10;
        $dni = DB::select("SELECT DATEDIFF(wypo_do, wypo_od) AS test FROM wypo WHERE id=".$wypo->id);

        $cena_d = ($motor->cena) * $dni[0]->test;

        $cena_c = $cena_dodatki+$cena_d;

        $wypo->cena_c = $cena_c;
        $wypo->save();



        
        }


    }

        //DB::table('moto')->where('id', $request->input('id_moto'))->update(['dostep' => '0']);

        return view('moto-loan-after');
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

        $motor->data_kons = $request->input('data_do');
        $motor->save();


        $wypo = $motor->wypo()->create([
            'id_moto' => $request->input('id_moto'),
            'id_user' => $user,
            'wypo_od' => $request->input('data_od'),
            'wypo_do' => $request->input('data_do'),
            'lok_z' => 'Warsztat',
            'lok_do' => 'Warsztat',
            'aktywne' => 1,
            'cena_c' => 0,
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

    public function logOrReg()
    {
        return view('log-or-reg');
    }

    public function check(Request $request)
    {
        
        $spr_data_od = $request->input('spr_data_od');
        $spr_data_do = $request->input('spr_data_do');

        if(Wypo::where('id_moto', '=', $request->input('id_moto'))
                ->where(function($query) use ( $spr_data_od, $spr_data_do )
                {
                    $query->WhereBetween('wypo_od', [ $spr_data_od, $spr_data_do])
                         ->orWhereBetween('wypo_do', [ $spr_data_od, $spr_data_do]);
                })
                
                ->exists()){
            Session::flash('message', 'Motor jest już zarezerwowany na ten okres!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }else{
            Session::flash('message', 'Motor jest dostępny w tym okresie.'); 
            Session::flash('alert-class', 'alert-info');
        return redirect('/');
    }


}
}
