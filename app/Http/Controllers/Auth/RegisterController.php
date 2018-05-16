<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Entrepreneur;
use App\Client;
use App\Ouvrier;
use Illuminate\Support\Facades\Storage;


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
        $validator = Validator::make($data, [
            'nom' => 'required|alpha|max:255',
            'prenom' => 'required|alpha|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'dateNaiss' => 'required|date|before:today', 
            'numTel' => 'required|digits:10',
            'wilaya' => 'integer|min:1|max:48|required',
            'region' => 'required|max:26',
            'adresse' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
        return $validator;
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
            case 'Entrepreneur' : 
                $utilisateur = Entrepreneur::create([
                    'experience' => 0,
                    'materiel' => $data['materiel'],
                    'reputation' => 0,
                    'nom_entreprise' => $data['nomEntreprise'],
                    'description_entreprise' => $data['descEntreprise']

                ]);
                
                break;
            case 'Ouvrier' :
                $utilisateur= Ouvrier::create([
                    'experience' => 0,
                    'reputation' => 0,
                    'fonction' => $data['fonction'],
                    'prixApprox' => 0
                ]);
                break;
            case 'Client' :
                $utilisateur= Client::create();
        }
        return User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'numTel' => $data['numTel'],
            'wilaya' => $data['wilaya'],
            'region' => $data['region'],
            'adresse' => $data['adresse'],
            'dateNaiss' => $data['dateNaiss'],
            'email' => $data['email'],
            'photoProfil' => config('images.path').'/default.png',
            'userable_id' => $utilisateur->id,
            'userable_type' => $data['type'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
