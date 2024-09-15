<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'integer','min:10'],
            'dni' => ['required', 'integer','min:8', 'unique:customers'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required_with:password', 'same:password'],
            'terms' => ['required', 'accepted'],
        ], [
            // Mensajes personalizados para las reglas de validación
            'name.required' => __('First name is required'),
            'last_name.required' => __('Last name is required'),
            'email.required' => __('Email is required'),
            'email.email' => __('Please enter a valid Email'),
            'email.unique' => __('Mail already exists'),
            'phone.required' => __('Phone is required'),
            'phone.min' => __('The phone number must be at least :min digits long.'),
            'phone.max' => __('The phone number must have a maximum of :max digits.'),
            'password.required' => __('Password required'),
            'password.min' => __('The password must be at least :min characters long'),
            'password.confirmed' => __('Passwords do not match'),
            'password_confirmation.required_with' => __('Please confirm password'),
            'password_confirmation.same' =>  __('Passwords do not match'),
            'terms.required' => __('You must accept the terms and conditions'), // Mensaje personalizado para la regla 'required' del campo 'terms'
            'terms.accepted' => __('You must accept the terms and conditions'), // Mensaje personalizado para la regla 'accepted' del campo 'terms'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $firstNameWords = explode(' ', $data['name']);
        $firstLastNameWords = explode(' ', $data['last_name']);
        $user = User::create([
            'name' => $firstNameWords[0] . ' ' . $firstLastNameWords[0],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
//            'password_confirm' => ['required_with:password', 'same:password'],
        ]);

        $user->assignRole('Customer');

        // Crear el cliente y asocia el user_id al usuario recién creado
        $customer = new Customer([
            'first_name' => $data['name'],
            'last_name' => $data['last_name'],
            'dni' => $data['dni'],
            'phone' => $data['phone'],
            'user_id' => $user->id,

        ]);

        // Guardar el registro del cliente en la tabla "customers"
        $saved = $customer->save();

        return $user;
    }
}
