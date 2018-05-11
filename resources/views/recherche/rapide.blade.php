@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">

	            	@forelse($resultats as $resultat)
	                <div class="panel panel-success">
	                	<div class="panel-heading">Projet de {{$resultat->client->user->nom}} {{$resultat->client->user->prenom}}</div>
	                	<div class="panel-body">
	                		<ul>
	                			<li>Description : {{$resultat->description}}</li>
	                			<li>Superficie : {{$resultat->superficie}}</li>
	                			<li>Wilaya : {{$resultat->wilaya}}</li>
	                			<li>Region : {{$resultat->region}}</li>
	                			<li>budget : {{$resultat->budget}}</li>
	                			<li>Delai : {{$resultat->delai}}</li>
	                			<li>{!!$resultat->necessiteEntrepreneur ? '<strong>Ce projet necessite un entrepreneur</strong>' : '' !!}</li>

	                		</ul>
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

