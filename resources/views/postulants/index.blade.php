@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header" style="background-color: rgb(0,193,97);color:white">Liste des postulants </h1>
					
	            	@forelse($postulants as $postulant)
					
	                <div class="panel panel-success">
					
	                	<div class="panel-body">
	                		<ul>
	                			<li>Nom : {{$postulant->user->nom}}</li>
	                			<li>Prenom : {{$postulant->user->prenom}}</li>
								<li>Email : {{$postulant->user->email}} </li>
								 <li>Wilaya : {{$postulant->user->wilaya}}</li>
                                <li>Region : {{$postulant->user->region}}</li>
                                <li>Numero de telephone : {{$postulant->user->numTel}}</li>
								<li>Experience : {{$postulant->experience}}</li>
	                		</ul>
	                		
	                	</div>
	                </div>
	                @empty
	                <div class="panel panel-danger">
	                	<div class="panel-heading">Aucun resultat</div>
	                	<div class="panel-body">
	                		Nous n'avons trouve aucun postulant.
	                	</div>
	                </div>
	                @endforelse
	                
	            </div>
	        </div>
	    </div>
	</div>
@endsection