<?php

namespace App\Http\Controllers;

use App\Moto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $motor->pojemnosc = $request->input('pojemnosc'). 'cm';
        $motor->moc = $request->input('moc') . 'KM';
        $motor->waga = $request->input('waga') . 'kg';
        $motor->zdj = 'motor/zdjecia/' . $filename;
        $motor->dostep = 1;
        $motor->save();

        return redirect()->back();
    }

    public function editMoto($id)
    {
        $moto = Moto::findOrFail($id);


        return view('moto-edit')
            ->with('moto', $moto);
    }

    public function doMoto(Request $request, $id)
    {
        $moto = Moto::find($id);

        $moto->name = $request->input('name_edit');
        $moto->email = $request->input('email_edit');

        $moto->save();
        return redirect()->back();
    }
}
