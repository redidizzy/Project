@extends('layouts.appConnected')

@section('content')
	<div class="retouches">
		<div class="container">
		<div class="panel panel-success">
			<div class="panel-heading">Bienvenue a votre espace admin, Que voullez-vous faire ? </div>
			<div class="panel-body">
				<ul>
					<li><a href="#">Gerer les utilisateurs</a>
						<ul>
						
							<li><a href="{{ route('admin.showAll', Auth::user()->id )}}" id="toggleVoirUtilisateurModal" style="color : rgb(120, 150, 120);">-Voir tous les utilisateurs</a></li>
							<li><a href="#" id="toggleVoirUtilisateurSignaleModal" style="color : rgb(120, 150, 120);">-Voir les utilisateurs signales</a></li>
						</ul>
					</li>
					<li> <a href="#">Gerer les Types de projets</a>
						<ul>
							<li><a href="#" id="toggleTypeProjModal"style="color : rgb(120, 150, 120);">-Voir les types de projets existants</a></li>
							<li><a href="#" id="toggleNewTypeProjModal"style="color : rgb(120, 150, 120);">-Creer un nouveau type de projet</a></li>
						</ul>
					</li>
					<li> <a href="#">Gerer les Types d'ouvriers</a>
						<ul>
							<li><a href="#" id="toggleVoirTypeOuvModal"style="color : rgb(120, 150, 120);">-Voir les types de projets existants</a></li>
							<li><a href="#" id="toggleNewTypeOuvModal"style="color : rgb(120, 150, 120);">-Creer un nouveau type de projet</a></li>
						</ul>
					</li>
				</ul>
				<div class="row">
					<div class="col-md-4">
						
					</div>
				</div>
				
				<div class="modal fade" id ="listerUtilisateursModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							
								<h4 class="modal-title">Liste utilisateurs</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
						<div class="modal-body">
						
							@forelse($utilisateurs as $utilisateur)
								@if(Auth::user()->is_admin == 0)
									<div class="panel panel-success">
										<div class="panel-heading"></div>
											<div class="panel-body">
												<p>{{$utilisateur->nom}}  {{$utilisateur->prenom}} {{$utilisateur->userable_type}}</p>
											</div>
										
									</div>	
								@endif
							@empty
									<div class="panel panel-danger">
										<div class="panel-heading">Aucun resultat</div>
										<div class="panel-body">
											Nous n'avons trouve aucun utilisateur.
										</div>
									</div>
									@endforelse
								
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
        </div>

      </div>
    </div> 
			
			
			</div>
		</div>
		</div>
	</div>
	
@endsection
 @section("script")   
    <script>
        $("#toggleVoirUtilisateurModal").on("click", function(e){
            e.preventDefault();
            $("#listerUtilisateursModal").modal();
        });
       
    </script>
@endsection