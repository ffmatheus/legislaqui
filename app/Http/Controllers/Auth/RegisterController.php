<?php

namespace App\Http\Controllers\Auth;

use App\Data\Models\City;
use App\Data\Models\State;
use App\Data\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Support\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;



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

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function




    userRegister(Request $request)
    {

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->createOrUpdate($request->all())));

        if(!Auth::user()){
            $this->guard()->login($user);
        }

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

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

        $this->middleware('canRegister');
    }

    protected function getRecaptchaRules()
    {
        return config('recaptcha.enabled')
            ? [recaptchaFieldName() => recaptchaRuleName()]
            : [];
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
        {
            return Validator::make(
                $data,
                array_merge(
                    $this->getValidator(Auth::user()),
                    $this->getRecaptchaRules()
                )
            );
        }


    protected function getValidator($social)
    {
        return $social ?
        [

        ]
        :
        [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'terms' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'city_id' => ['required'],
            'uf' => ['required']
        ];

    }
    /**
     * Create a new user (citizen - 99) instance after a valid registration.
     *
     * @param array $data
     *
     * @return model user
     */
    protected function createOrUpdate(array $data)
    {

        if (Auth::user()){
            $user = User::where('id' , Auth::user()->id)->first();
            User::where('id', $user->id)->update([
                'cpf' => only_numbers($data['cpf']),
                'city_id' => $data['city_id'],
                'uf' => $data['uf'],
            ]);
            return $user;
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'uf' => $data['uf'],
            'city_id' => $data['city_id'],
            'role_id' => get_role_id(Constants::ROLE_CIDADAO),
            'cpf' => only_numbers($data['cpf']),
            'whatsapp' => only_numbers($data['whatsapp']),
            'uuid' => $data['uuid']
        ]);
    }

    // Register Method Overload
    public function register(Request $request)
    {
        // Request comes  from Register form
        \Session::put('last_auth_attempt', 'register');

        redirect('auth.login');

        // If Captcha is OK, then register User Request
        $register = $this->userRegister($request);

        \Session::flash('flash_msg', 'Registro feito com Sucesso.');

        return $register;
    }

    // showRegistrationForm Method Overload
    public function showRegistrationForm()
    {
        $cities = City::all()->pluck('name', 'id');

        return view('auth.register', compact('cities'));
    }
}
