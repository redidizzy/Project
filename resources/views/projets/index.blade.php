@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header">Projets de {{$user->nom}}</h1>
	            	@forelse($projets as $projet)
	                <div class="panel panel-success">
	                	<div class="panel-heading">Projet de {{$projet->type->designation}}</div>
	                	<div class="panel-body">
	                		<ul>
	                			<li>Description : {{$projet->description}}</li>
	                			<li>Superficie : {{$projet->superficie}}</li>
	                			<li>Wilaya : {{$projet->wilaya}}</li>
	                			<li>Region : {{$projet->region}}</li>
	                			<li>Adresse : {{$projet->adresse}} </li>
	                			<li>Budget : {{$projet->budget}}</li>
	                			<li>Delai : {{$projet->delai}}</li>
	                			<li>{{$projet->necessiteEntrepreneur ? 'Ce Projet necessite un entrepreneur' : 'Ce projet ne necessite pas d\'entrepreneur'}}</li>
	                		</ul>
	                		@if(Auth::user()->id == $user->id)
		                	<div class="col-md-4">
		                		<a href="{{route('projets.edit', $projet->id)}}" class="btn btn-warning">Editer</a>
		                		<form method="post" action = "{{route('projets.destroy', $projet->id)}}">
		                			{{csrf_field()}}
		                			<input type="hidden" value="DELETE" name="_method" >
		                			<input type="submit" class="btn btn-danger" value = "Supprimer">
		                		</form>
		                	</div>
		                	@endif
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
	                @if(Auth::user()->id == $user->id)
	                <div class="col-md-3 pull-right">
	                	<a class="btn btn-success btn-block" href="{{route('projets.create')}}">Creer un projet</a>
	                </div>
	                @endif
	            </div>
	        </div>
	    </div>
	</div>
@endsection