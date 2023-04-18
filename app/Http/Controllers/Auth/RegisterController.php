<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeSend;
use App\Notifications\AdminEmailNotification;
use App\Notifications\UserEmailNotification;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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
     * form_degree
     * form_specialization - v
     * form_practice - v
     * form_name - v
     * form_surname - v
     * form_pesel - v
     * form_postcode - v
     * form_city - v
     * form_address - v
     * form_email - v
     * form_phone - v
     * form_password - v
     * form_confirm
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'form_name' => ['required', 'string', 'max:255'],
            'form_surname' => ['required', 'string', 'max:255'],
            'form_specialization' => ['required', 'string', 'max:190'],
            'form_practice' => ['required', 'string', 'max:190'],
            'form_pesel' => ['required', 'string', 'max:190'],
            'form_postcode' => ['required', 'string', 'max:190'],
            'form_city' => ['required', 'string', 'max:190'],
            'form_address' => ['required', 'string', 'max:190'],
            'form_phone' => ['required', 'string', 'max:190'],
            'form_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'form_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['form_name'],
            'surname' => $data['form_surname'],
            'specialization' => $data['form_specialization'],
            'practice' => $data['form_practice'],
            'pesel' => $data['form_pesel'],
            'postcode' => $data['form_postcode'],
            'city' => $data['form_city'],
            'address' => $data['form_address'],
            'phone' => $data['form_phone'],
            'degree' => $data['form_degree'],
            'email' => $data['form_email'],
            'password' => Hash::make($data['form_password']),
        ]);

        $admin = User::first();

        $admin_notify = [
            'subject' => 'Podkarpacki Oddział PTMSiZP - rejestracja nowego konta: '.date('d-m-Y'),
            'greeting' => 'Witaj '.$admin->name.',',
            'body' =>'w systemie pojawiła się nowa rejestracja użytkownika.<br><table class="table"><tr><td>Data:</td><td>'.date('d-m-Y').'</td></tr><tr><td>Imie:</td><td>'.$data['form_name'].'</td></tr><tr><td>Nazwisko:</td><td>'.$data['form_surname'].'</td></tr><tr><td>Adres e-mail:</td><td>'.$data['form_email'].'</td></tr></table>',
            'regards' => 'Pozdrawiam'
        ];

        Notification::send($admin, new AdminEmailNotification($admin_notify));

        $user_notify = [
            'subject' => 'Podkarpacki Oddział PTMSiZP - potwierdzenie rejestracji',
            'greeting' => 'Witaj '.$user->name.',',
            'body' => 'dziękujemy za dokonanie rejestracji w serwisie Podkarpacki Oddział PTMSiZP. Twoje konto wymaga weryfikacji przez administratora. Po aktywacji konta otrzymasz wiadomość.'
        ];

        Notification::send($user, new UserEmailNotification($user_notify));

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect()->route('thankyou');
    }
}
