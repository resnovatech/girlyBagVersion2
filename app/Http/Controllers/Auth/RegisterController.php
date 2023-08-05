<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Mail;
use Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
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

        // dd(1);
        // return User::create([
        //     'name' => $data['name'],
        //     'lname' => $data['lname'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

        $store_data = new User();
        $store_data->name = $data['name'];
        $store_data->lname = $data['lname'];
        $store_data->non_verified_email = $data['email'];
        $store_data->password = Hash::make($data['password']);
        $store_data->save();

                $customerId = $store_data->id;
                Session::put('customerId',$customerId);


                Mail::send('emails.passwordResetEmail', ['id' => $customerId], function($message) use($data){
                    $message->to($data['email']);
                    $message->subject('Confirmation Mail');
                });

        Toastr::success('Check Mail:)' ,'Success');
        return redirect('customer_login');
    }
}
