@extends('layouts.appConnected')
@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header" style="background-color:rgb(0,193,97);color:white">Demandes d'emploi </h1>
	            	@forelse($demandes as $demande)
	                <div class="panel panel-success">
					
	                	<div class="panel-heading">Demande de : {{$demande->ouvrier->user->nom}}  {{$demande->ouvrier->user->prenom}}</div>
	                	<div class="panel-body">
	                		<p>Le contenu : </br></br>{{$demande->contenu}}</p>
							<p><small >cree le : {{$demande->created_at}} </small></p>
							<div class="panel-footer">
							<h5>Contactez moi</h5>
							
							Numero de telephone : {{$demande->ouvrier->user->numTel}}</br>
							Email : {{$demande->ouvrier->user->email}}
							
							</div>
				
						</div>

	                </div>
	               
	                @empty
	                <div class="panel panel-danger">
	                	<div class="panel-heading">Aucun resultat</div>
	                	<div class="panel-body">
	                		Nous n'avons trouve aucune demande.
	                	</div>
	                </div>
	                @endforelse
	                
				</div>	
			</div>
		</div>

	</div>
	
@endsection