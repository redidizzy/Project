@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header" class="page-header" style="color:black; background:rgb(0,200,100); padding : 10px 10px 10px 10px; border-radius:10px;">Liste des postulants </h1>
					
	            	@forelse($postulants as $postulant)
					
	                <div class="panel panel-success">
						<div class="panel-heading">
							<a href="{{route('utilisateur.profil', $postulant->user->id)}}">{{$postulant->user->nom}} {{$postulant->user->prenom}}</a>
						</div>
	                	<div class="panel-body">
	                		<ul>
								<li>Email : {{$postulant->user->email}} </li>
								 <li>Wilaya : {{$postulant->user->wilaya}}</li>
                                <li>Region : {{$postulant->user->region}}</li>
                                <li>Numero de telephone : {{$postulant->user->numTel}}</li>
								<li>Experience : {{$postulant->attestations->count()}} Attestations d'affiliation a la CNAS</li>
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