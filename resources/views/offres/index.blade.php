@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header" style="color:rgb(0,255,128)">Offres d'emploi de {{$user->nom}}  {{$user->prenom}}</h1>
	            	@forelse($offres as $offre)
	                <div class="panel panel-success">
	                	<div class="panel-heading">Poste : {{$offre->type->designation}}</div>
	                	<div class="panel-body">
	                		<p>Le contenu : </br></br>{{$offre->contenu}}</p>
							<p><small >cree le : {{$offre->created_at}} </small></p>
	    
	                		@if(Auth::user()->id == $user->id )
								@if(Auth::user()->userable_type === "Entrepreneur")
								<div class="col-md-4">
									<a href="{{route('offres.edit', $offre->id)}}" class="btn btn-success">Editer</a>
									<a href="#" class="btn btn-success">Voir liste postulants</a>
									<form method="post" action = "{{route('offres.destroy', $offre->id)}}">
										{{csrf_field()}}
										<input type="hidden" value="DELETE" name="_method" />
										<input type="submit" class="btn btn-danger" value = "Supprimer"/>
									</form>
								</div>
								

								@elseif((Auth::user()->userable_type === "Ouvrier"))
									
									<div class="col-md-4">
								
										<a href="{{route('offres.addPostulant', $offre->id)}}" class="btn btn-success">Postuler</a>
										
									</div>
								@endif
		                	@endif
							
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
	                @if(Auth::user()->id == $user->id)
	                <div class="col-md-3 pull-right">
	                	<a class="btn btn-success btn-block" href="{{route('offres.create')}}">Ajouter offre d'emploi</a>
	                </div>
	                @endif
	            </div>
	        </div>
	    </div>
	</div>
@endsection