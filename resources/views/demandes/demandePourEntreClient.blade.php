@extends('layouts.appConnected')
@section('content')

    <div class="retouches">
        <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            	<h1 class="page-header" style="color:black; background:rgb(0,200,100); padding : 10px 10px 10px 10px; border-radius:10px;">Demandes d'emploi </h1>
	            	@forelse($demandes as $demande)
	                <div class="panel panel-success">
					
	                	<div class="panel-heading" id="heading-styling">
	                		<div>Demande de : {{$demande->ouvrier->user->nom}}  {{$demande->ouvrier->user->prenom}}</div>
	                		<div><small >cree le : {{$demande->created_at}} </small></div> 
	                	</div>
	                	<div class="panel-body">
	                		<p>Le contenu : </br></br>{{$demande->contenu}}</p>
	                	</div>
							<div class="panel-footer">
							<h5>Contactez moi</h5>
							
							Numero de telephone : {{$demande->ouvrier->user->numTel}}</br>
							Email : {{$demande->ouvrier->user->email}}
							
							</div>
				
						

	                </div>
	               
	                @empty
	                <div class="panel panel-danger">
	                	<div class="panel-heading">Aucun resultat</div>
	                	<div class="panel-body">
	                		Nous n'avons trouve aucune demande.
	                	</div>
	                	<div class="panel-footer clearfix">
                        <a href="{{url()->previous()}}" class="btn btn-success floatRight">Retour</a>
                    </div>
	                </div>
	                @endforelse
	                
				</div>	
			</div>
		</div>

	</div>
	
@endsection