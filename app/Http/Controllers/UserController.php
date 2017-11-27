<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Redirect;

class UserController extends Controller
{

    public function index()
    {
        if(!Auth::check())
        return Redirect::to('/');
        if(!Auth::user()->hasRole('Administratorius'))
        Redirect::back();
        $darbuotojai = User::select('users.*',DB::raw('roles.name as role'))->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->where('roles.name','Darbuotojas')->orWhere('roles.name','Administratorius')->get();
        return View('darbuotojai.sarasas',compact('darbuotojai'));
    }

    public function destroy($id)
    {
        if(!Auth::check())
        return Redirect::to('/');
        if(!Auth::user()->hasRole('Administratorius'))
        return Redirect::back();
        $user = User::findOrFail($id);
        $user->delete();
        return Redirect::back();
    }
}
