<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'birth_date'=>'required|date',
            'address'=>'string|max:50',
            'phone'=>'required|string|max:50'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'id'=>0,
            'name' => $data['name'],
            'email' => $data['email'],
            'surname' => $data['surname'],
            'password' => bcrypt($data['password']),
            'person_id'=>$data['person_id'],
            'birth_date'=>$data['birth_date'],
            'address'=>$data['address'],
            'has_license'=>$data['has_license'],
            'license_from'=>$data['license_from'],
            'phone'=>$data['phone']
        ]);
        if(isset($data['role']))
        {
        $user->roles()->attach(Role::where('name',$data['role']));
        return Redirect::to('/');
        
        }
        else
        {
        $user->roles()->attach(Role::where('name', 'Klientas')->first());
        }
     return $user;
    }
}
