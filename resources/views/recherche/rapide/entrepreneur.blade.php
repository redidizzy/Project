@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
					
	            	@forelse($entrepreneurs as $entrepreneur)

	                <div class="panel panel-success">
	                	<div class="panel-heading"><a href="{{route('utilisateur.profil', $entrepreneur->id)}}">{{$entrepreneur->nom}} {{$entrepreneur->prenom}}</a></div>
	                	<div class="panel-body">
	                		<ul class="floatLeft col-md-6">
	                			<li>Nom : {{$entrepreneur->nom}}</li>
	                			<li>prenom : {{$entrepreneur->prenom}}</li>
	                			<li>Numero de telephone : {{$entrepreneur->numTel}}</li>
	                			<li>Wilaya : {{$entrepreneur->wilaya}}</li>
	                			<li>Region : {{$entrepreneur->region}}</li>
	                			<li>Adresse e-mail : {{$entrepreneur->email}}</li>
	                			<li>Date de naissance : {{$entrepreneur->dateNaiss}}</li>
	                			<li>Experience : {{$entrepreneur->userable->experience}} attestations de bonne execution</li>
	                			<li>Materiel : {{$entrepreneur->userable->materiel}}</li> 
	                			<li>reputation : {{$entrepreneur->userable->reputation}}</li>
	                			

	                		</ul>
	                		<div class="floatRight">
	                			<img src="{{asset($entrepreneur->photoProfil)}}" style="width:300px"/>
	                		</div>
	                		
	                	</div>
	                </div>
	                @empty
	                <div class="panel panel-danger">
	                	<div class="panel-heading">Aucun resultat</div>
	                	<div class="panel-body">
	                		nous n'avons trouve aucun element satisfaisant vos criteres
	                	</div>
	                </div>
	                @endforelse
	            </div>
	        </div>
	    </div>
	</div>
@endsection

