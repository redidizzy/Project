@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Information General</div>

                <div class="panel-body">
                    <div class="row">
                        <ul class="col-md-6">
                            
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
        @if($user->userable_type != "Client")
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Informations professionnel</div>

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
