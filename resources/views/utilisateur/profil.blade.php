@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Information General</div>

                <div class="panel-body">
                    <ul>
                        
                        <li>nom : {{$user->nom}}</li>
                        <li>prenom : {{$user->prenom}}</li>
                        <li>date de naissance : {{$user->dateNaiss}} </li>
                        <li>email : {{$user->email}} </li>
                        <li>wilaya : {{$user->wilaya}}</li>
                        <li>region : {{$user->region}}</li>
                        <li>numero de telephone : {{$user->numTel}}</li> 
                        <li>Type d'utilisateur : {{$user->userable_type}}</li>
                    </ul>
                </div>
            </div>
        </div>
        @if($user->userable_type != "Client")
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Informations professionnel</div>
0
                    <div class="panel-body">
                            
                            <li>reputation : {{$user->userable->reputation}}</li>
                            <li>experience : {{$user->userable->experience}}</li>
                        <ul>
                            @if($user->userable_type === "Entrepreneur")
                                <li>disponibilite: {{$user->userable->disponibilite}}</li>
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
        @endif
    </div>
</div>
@endsection
