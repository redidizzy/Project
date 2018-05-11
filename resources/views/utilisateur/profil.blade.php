@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-success">

                    <div class="panel-heading">Information General</div>

                    <div class="panel-body">
                        <div class="row">
                            <ul class="col-md-8">
                                
                                <li>nom : {{$user->nom}}</li>
                                <li>prenom : {{$user->prenom}}</li>
                                <li>date de naissance : {{$user->dateNaiss}} </li>
                                <li>email : {{$user->email}} </li>
                                <li>wilaya : {{$user->wilaya}}</li>
                                <li>region : {{$user->region}}</li>
                                <li>numero de telephone : {{$user->numTel}}</li> 
                                <li>Type d'utilisateur : {{$user->userable_type}}</li>
                            </ul>
                            <div class="col-md-4 col-md-offset-2">
                                <img src="{{asset($user->photoProfil)}}" style="height : 200px; " />
                            </div>
                        </div>
                        
                        <?php if(Auth::user()->id === $user->id )
                        {
                        ?>
                        <div class="text-center">
                            <a href="{{route('utilisateur.edit')}}" class="btn btn-success">Editer</a>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
                @if($user->userable_type != "Client")
                    <div class="panel-center row">
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">Informations professionnel</div>

                                <div class="panel-body">
                                    <ul>    
                                        <li>reputation : {{$user->userable->reputation}}</li>
                                        <li>experience : {{$user->userable->experience}}</li>
                                    
                                        @if($user->userable_type === "Entrepreneur")
                                            <li>{{$user->userable->disponibilite ? 'Vous etes Disponible' : 'Vous N\'etes Pas Disponible' }}</li>
                                            <li>materiel : {{$user->userable->materiel}} </li>
                                        @else
                                            <li>diplome : {{$user->userable->diplome}}</li>
                                            <li>profession : {{$user->userable->fonction}}</li>
                                            <li>prix Approximatif : {{$user->userable->prixApprox}}</li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">Boite a outils</div>
                                <div class="panel-body text-center">

                                    @if($user->userable_type === "Entrepreneur")
                                        <a href="#" class="btn btn-primary btn-block">Importer attestation de bonne execution </a>
                                        <a href="#" class="btn btn-warning btn-block">Remplir materiel</a>
                                        <a href="#" class="btn btn-danger btn-block">Changer Disponibilite</a>
                                    @else
                                        <a href="#" class="btn btn-primary btn-block">Ajouter Diplome</a>
                                        <a href="#" class="btn btn-warning btn-block">Changer de Profession</a>
                                        <a href="#" class="btn btn-danger btn-block">Changer de Prix Approximatif</a>

                                    @endif

                                    <a href="#" class="btn btn-info btn-block">Changer mot de passe</a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        
</div>
@endsection
