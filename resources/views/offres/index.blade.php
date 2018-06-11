@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header" style="color:black; background:rgb(0,200,100); padding : 10px 10px 10px 10px; border-radius:10px;">Offres d'emploi de {{$user->nom}}  {{$user->prenom}}</h1>
	            	@forelse($offres as $offre)
	                <div class="panel panel-success">
	                	<div class="panel-heading" id="heading-styling">
	                		<div>Poste : {{$offre->type->designation}}</div>
	                		<div><small >cree le : {{$offre->created_at}} </small></div>
	                	</div>
	                	<div class="panel-body">
	                		<p>Le contenu : </br></br>{{$offre->contenu}}</p>
							
	    
	                		@if(Auth::user()->id == $user->id )
								
								<div class="col-md-4">
									<a href="{{route('offres.edit', $offre->id)}}" class="btn btn-success">Editer</a>
									<a href="{{route('offres.afficherLesPostulants',$offre->id) }} " class="btn btn-success">Voir liste postulants</a>
									<form method="post" action = "{{route('offres.destroy', $offre->id)}}">
										{{csrf_field()}}
										<input type="hidden" value="DELETE" name="_method" />
										<input type="submit" class="btn btn-danger" value = "Supprimer"/>
									</form>
								</div>
								

								
		                	@endif
							
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
	                	<div class="panel-footer clearfix">
                       		 <a href="{{url()->previous()}}" class="btn btn-success floatRight">Retour</a>
                    	</div>
	                </div>
	                @endforelse
	                <div class="links-pagination">{{ $links }} </div>
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