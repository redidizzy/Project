@extends('layouts.appConnected')
@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header" style="background-color:rgb(0,193,97);color:white">Offres d'emploi </h1>
	            	@forelse($offres as $offre)
	                <div class="panel panel-success">
					
	                	<div class="panel-heading">Offre de : {{$offre->entrepreneur->user->nom}}  {{$offre->entrepreneur->user->prenom}}</div>
	                	<div class="panel-body">
	                		<p>Le contenu : </br></br>{{$offre->contenu}}</p>
							<p><small >cree le : {{$offre->created_at}} </small></p>
								
								<a class="btn btn-success btn-block col-sm-2" href="{{route('offres.addPostulant',[$offre->id,Auth::user()->userable->id])}}">Postuler</a>
							
							
						</div>

	                </div>
	               
	                @empty
	                <div class="panel panel-danger">
	                	<div class="panel-heading">Aucun resultat</div>
	                	<div class="panel-body">
	                		Nous n'avons trouve aucune offre.
	                	</div>
	                </div>
	                @endforelse
	                
				</div>	
			</div>
		</div>

	</div>
	
@endsection