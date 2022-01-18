<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use http\Env\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

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
    | Extended by Mian Salman SK Developers, All methods override.
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Write code on Method
     *
     * @return view()
     */
    public function showRegistrationForm(): view
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('auth.register',compact('categories'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_num' => ['required', 'string', 'mobile_num', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, User  $user =null)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'company_name' => $data['company_name'],
            'owner_name' => $data['owner_name'],
            'mobile_num' => $data['mobile_num'],
            'whatsapp_num' => $data['whatsapp_num'],
            'categories' =>  $data['categories'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
