<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Redirect;
use App\Role;

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

    public function prideti()
    {
        if(!Auth::check())
        return Redirect::to('/');
        if(!Auth::user()->hasRole('Administratorius'))
        return Redirect::back();
        return View('darbuotojai.prideti');
    }
    public function store()
    {
        $user = new User;
        $user->id=0;
        $user->name=request('name');
        $user->surname=request('surname');
        $user->email=request('email');
        $user->password=bcrypt(request('password'));
        $user->person_id=request('person_id');
        $user->birth_date=request('birth_date');
        $user->address=request('address');
        $user->has_license=request('has_license');
        $user->license_from=request('license_from');
        $user->phone=request('phone');
        $user->save();
        $user->roles()->attach(Role::where('name',request('role'))->first());
        return Redirect::to('/darbuotojai');
    }
}
