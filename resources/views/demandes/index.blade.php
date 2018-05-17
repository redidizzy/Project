@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header" style="color:black; background:rgb(0,200,100); padding : 10px 10px 10px 10px; border-radius:10px;">Demandes d'emploi de {{$user->nom}}  {{$user->prenom}}</h1>
	            	@forelse($demandes as $demande)
	                <div class="panel panel-success">
	                	<div class="panel-heading">Fonction : {{$demande->ouvrier->fonction}}</div>
	                	<div class="panel-body">
	                		<p>Le contenu : </br></br>{{$demande->contenu}}</p>
	    
	                		@if(Auth::user()->id == $user->id)
		                	<div class="col-md-4">
		                		<a href="{{route('demandes.edit', $demande->id)}}" class="btn btn-success">Editer</a>
		                		<form method="post" action = "{{route('demandes.destroy', $demande->id)}}">
		                			{{csrf_field()}}
		                			<input type="hidden" value="DELETE" name="_method" />
		                			<input type="submit" class="btn btn-danger" value = "Supprimer"/>
		                		</form>
		                	</div>
		                	@endif
	                	</div>
	                </div>
	                @empty
	                <div class="panel panel-danger">
	                	<div class="panel-heading">Aucun resultat</div>
	                	<div class="panel-body">
	                		Nous n'avons trouve aucun element satisfaisant vos criteres.
	                	</div>
	                </div>
	                @endforelse
	                @if(Auth::user()->id == $user->id)
	                <div class="col-md-3 pull-right">
	                	<a class="btn btn-success btn-block" href="{{route('demandes.create')}}">Ajouter demande d'emploi</a>
	                </div>
	                @endif
	            </div>
	        </div>
	    </div>
	</div>
@endsection