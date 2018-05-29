<?php

namespace App\Http\Controllers;

use App\User;
use App\Moto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function viewUserList()
    {

        $users = User::all();


        return view('user-list')
            ->with('users', $users);
    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);


        return view('user-edit')
            ->with('user', $user);
    }

    public function doEdit(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->input('name_edit');
        $user->email = $request->input('email_edit');
        $user->telefon = $request->input('telefon_edit');
        if(Auth::user()->auth == '3'){
        $user->auth = $request->input('auth_edit');
        }

        $user->save();
        return redirect()->back();
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
           
            $user->delete();

        return redirect()->back();

    }


    public function viewUserAccount($id)
    {

        $user = User::find($id);


        return view('user.user-view')
            ->with('user', $user);
    }

}
