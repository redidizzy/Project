@extends('layouts.appConnected')
@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header" style="background-color:rgb(0,193,97);color:white">Offres d'emploi </h1>
	            	@forelse($offres as $offre)
	                <div class="panel panel-success">
					
	                	<div class="panel-heading" id="heading-styling">
	                		<div>Offre de : {{$offre->entrepreneur->user->nom}}  {{$offre->entrepreneur->user->prenom}}</div>
	                		<div><small >cree le : {{$offre->created_at}} </small></div>
	                	</div>
	                	<div class="panel-body">
	                		<p>Le contenu : </br></br>{{$offre->contenu}}</p>	
						</div>
						@if(Auth::user()->userable_type == 'Ouvrier')
	                	@if(Auth::user()->userable->dejaPostule($offre))
	                		<div class="panel-footer clearfix">
		                		<p class="alert alert-success floatRight">Vous avez deja postule a cette offre</a>
		                	</div>
	                	@else
		                	<div class="panel-footer clearfix">
		                		<a href="{{route('offres.addPostulant', $offre->id)}}" class="btn btn-success floatRight">Postuler</a>
		                	</div>
		                @endif
	                	@endif

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