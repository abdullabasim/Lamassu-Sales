<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Model\Role;

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
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __contruct(Request $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $this->request = $request;
        $this->middleware('auth');
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'picture'=>'required',
            'permission'=>'required'
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

        $role =Role::findOrFail($data['permission']);

         $pictureName=$this->randomCode(10).\Input::file('picture')->getClientOriginalName();

        \Input::file('picture')->move(public_path('files'), $pictureName );


        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'picture'=>$pictureName,
        ]);
        $user ->roles()
            ->attach(Role::where('name', $role->name)->first());

        return $user;
    }

    /**
     * Generate Random code
     *
     * @param $length
     * @return string
     */
    public  function randomCode($length)
    {
        $chars = "1234567890";
        $clen   = strlen( $chars )-1;
        $code  = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return ($code);
    }
}
