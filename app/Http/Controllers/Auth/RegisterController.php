<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Entrepreneur;
use App\Client;
use App\Ouvrier;


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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            

            'password' => 'required|string|min:6|confirmed',
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
        $utilisateur;
        switch($data['type'])
        {
            /** @todo indiquer le reste des types possible et finir le formulaire*/
            case 'entrepreneur' : 
                $utilisateur = Entrepreneur::create([
                    'experience' => 0,
                    'disponibilite' => true,
                    'materiel' => '',
                    'reputation' => 0
                ]);
                break;
            case 'ouvrier' :
                $utilisateur= Ouvrier::create([
                    'diplome' => isset($data['diplome']),
                    'experience' => 0,
                    'reputation' => 0,
                    'fonction' => $data['fonction'],
                    'prixApprox' => 0
                ]);
                break;
            case 'client' :
                $utilisateur= Client::create();
        }
        return User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'numTel' => $data['numTel'],
            'wilaya' => $data['wilaya'],
            'region' => $data['region'],
            'dateNaiss' => $data['dateNaiss'],
            'email' => $data['email'],
            'userable_id' => $utilisateur->id,
            'userable_type' => $data['type'],
            'password' => bcrypt($data['password']),
        ]);
    }
}