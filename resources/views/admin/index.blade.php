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
						
							<li><a href="#" id="toggleVoirUtilisateurModal" style="color : rgb(120, 150, 120);">-Voir tous les utilisateurs</a></li>
							<li><a href="#" id="toggleVoirUtilisateurSignaleModal" style="color : rgb(120, 150, 120);">-Voir les utilisateurs signales</a></li>
							<li><a href="#" id="toggleVoirUtilisateurBannisModal" style="color : rgb(120, 150, 120);">-Voir les utilisateurs bannis</a></li>
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
							<li><a href="#" id="toggleVoirTypeOuvModal"style="color : rgb(120, 150, 120);">-Voir les types d'ouvrier existants</a></li>
							<li><a href="#" id="toggleNewTypeOuvModal"style="color : rgb(120, 150, 120);">-Creer un nouveau type d'ouvrier</a></li>
						</ul>
					</li>
				</ul>
				
        		</div>

     		</div>
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
			
				
						<table class="table table-hover" width="100%">
							<thead>
								<th>ID</th>
								<th>Nom</th>
								<th>Prenom</th>
								<th>Numero de Telephone</th>
								<th>Wilaya</th>
								<th>Commune</th>
								<th>Adresse</th>
								<th>Email</th>
								<th>Date de Naissance</th>
								<th>Membre depuis</th>
								<th>Type d'Utilisateur</th>
							</thead>
							<tbody>
							@foreach($utilisateurs as $utilisateur)

								<tr>
									<td>{{$utilisateur->id}}</td>
									<td><a href="{{route('utilisateur.profil', $utilisateur->id)}}">{{$utilisateur->nom}}</a></td>
									<td><a href="{{route('utilisateur.profil', $utilisateur->id)}}">{{$utilisateur->prenom}}</a></td>
									<td>{{$utilisateur->numTel}}</td>
									<td>{{config('variables.wilayas.'.$utilisateur->wilaya)}}</td>
									<td>{{$utilisateur->region}}</td>
									<td>{{$utilisateur->adresse}}</td>
									<td>{{$utilisateur->email}}</td>
									<td>{{$utilisateur->dateNaiss}}</td>
									<td>{{$utilisateur->created_at}}</td>
									<td>{{$utilisateur->userable_type}}</td>
									<td><a href="{{route('makeAdmin', $utilisateur->id)}}" class="btn btn-success">Rendre administrateur</a></td>
									<td><a href="{{route('ban', $utilisateur->id)}}" class="btn btn-danger">Bannir</a></td>
								</tr>
							@endforeach
							</tbody>
						</table>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id ="listerTypeOuvrierModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				
					<h4 class="modal-title">Liste des types d'ouvriers</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="modal-body">
			
				
						<table class="table table-hover" width="100%">
							<thead>
								<th>Designation</th>
								<th>Description</th>
							</thead>
							<tbody>
							@foreach($typesOuvrier as $type)
								<tr>
									<td>{{$type->designation}}</td>
									<td>{{$type->description}}</td>
									<td><a href="#" class="btn btn-warning">Modifier</a></td>
								<td><a href="#" class="btn btn-danger">Supprimer</a></td>
								</tr>
							@endforeach
							</tbody>
						</table>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="creerTypeOuvrierFromModal" data-dismiss="modal">Creer un nouveau type d'ouvrier</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id ="listerTypeProjetModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				
					<h4 class="modal-title">Liste des types d'ouvriers</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="modal-body">
			
				
						<table class="table table-hover" width="100%">
							<thead>
								<th>Designation</th>
								<th>Description</th>
							</thead>
							<tbody>
							@foreach($typesProjet as $type)
								<tr>
									<td>{{$type->designation}}</td>
									<td>{{$type->description}}</td>
									<td><a href="#" class="btn btn-warning">Modifier</a></td>
									<td><a href="#" class="btn btn-danger">Supprimer</a></td>
								</tr>
							@endforeach
							</tbody>
						</table>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="creerTypeProjetFromModal" data-dismiss="modal">Creer un nouveau type de projet</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id ="CreerTypeProjetModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				
					<h4 class="modal-title">Creer un type de projet</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="modal-body">
			
				<form action="{{route('creerTypeProjet')}}" id="creerTypeProjetForm" method="POST">
					{{csrf_field()}}
					<div class="col-md-8 form-group">
						<input class="form-control" placeholder="Designation du type" name="designation" id="designation" />
					</div>
					<div class="col-md-8 form-group">
						<textarea class="form-control" placeholder="Description tres bref du type" name="description" id="description" ></textarea>
					</div>  
				</form>
					
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" id="creerTypeProjetSubmit">Creer</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id ="CreerTypeOuvrierModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				
					<h4 class="modal-title">Creer un type d'ouvrier</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="modal-body">
			
				<form action="{{route('creerTypeOuvrier')}}" id="creerTypeOuvrierForm" method="POST">
					{{csrf_field()}}
					<div class="col-md-8 form-group">
						<input class="form-control" placeholder="Designation du type" name="designation" id="designation" />
					</div>
					<div class="col-md-8 form-group">
						<textarea class="form-control" placeholder="Description tres bref du type" name="description" id="description" ></textarea>
					</div>  
				</form>
					
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" id="creerTypeOuvrierSubmit">Creer</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id ="listerUtilisateursSignaleModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				
					<h4 class="modal-title">Liste des utilisateurs signale</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="modal-body">
			
				
						<table class="table table-hover" width="100%">
							<thead>
								<th>ID</th>
								<th>Nom</th>
								<th>Prenom</th>
								<th>Numero de Telephone</th>
								<th>Wilaya</th>
								<th>Commune</th>
								<th>Adresse</th>
								<th>Email</th>
								<th>Date de Naissance</th>
								<th>Membre depuis</th>
								<th>Type d'Utilisateur</th>
								<th>NB de signalement</th>
							</thead>
							<tbody>
							@foreach($utilisateursSignale as $utilisateur)

								<tr>
									<td>{{$utilisateur->id}}</td>
									<td><a href="{{route('utilisateur.profil', $utilisateur->id)}}">{{$utilisateur->nom}}</a></td>
									<td><a href="{{route('utilisateur.profil', $utilisateur->id)}}">{{$utilisateur->prenom}}</a></td>
									<td>{{$utilisateur->numTel}}</td>
									<td>{{config('variables.wilayas.'.$utilisateur->wilaya)}}</td>
									<td>{{$utilisateur->region}}</td>
									<td>{{$utilisateur->adresse}}</td>
									<td>{{$utilisateur->email}}</td>
									<td>{{$utilisateur->dateNaiss}}</td>
									<td>{{$utilisateur->created_at}}</td>
									<td>{{$utilisateur->userable_type}}</td>
									<td>{{$utilisateur->signalements->count()}}<a href="#" id="voirMotif">(Voir motifs)</a></td>
									<td><a href="{{route('ban', $utilisateur->id)}}" class="btn btn-danger">Bannir</a></td>
								</tr>
							@endforeach
							</tbody>
						</table>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id ="listerUtilisateursBannisModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				
					<h4 class="modal-title">Liste des utilisateurs Bannis</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="modal-body">
			
				
						<table class="table table-hover" width="100%">
							<thead>
								<th>ID</th>
								<th>Nom</th>
								<th>Prenom</th>
								<th>Numero de Telephone</th>
								<th>Wilaya</th>
								<th>Commune</th>
								<th>Adresse</th>
								<th>Email</th>
								<th>Date de Naissance</th>
								<th>Membre depuis</th>
								<th>Type d'Utilisateur</th>
							</thead>
							<tbody>
							@foreach($utilisateursBannis as $utilisateur)

								<tr>
									<td>{{$utilisateur->id}}</td>
									<td><a href="{{route('utilisateur.profil', $utilisateur->id)}}">{{$utilisateur->nom}}</a></td>
									<td><a href="{{route('utilisateur.profil', $utilisateur->id)}}">{{$utilisateur->prenom}}</a></td>
									<td>{{$utilisateur->numTel}}</td>
									<td>{{config('variables.wilayas.'.$utilisateur->wilaya)}}</td>
									<td>{{$utilisateur->region}}</td>
									<td>{{$utilisateur->adresse}}</td>
									<td>{{$utilisateur->email}}</td>
									<td>{{$utilisateur->dateNaiss}}</td>
									<td>{{$utilisateur->created_at}}</td>
									<td>{{$utilisateur->userable_type}}</td>
									<td><a href="{{route('unban', $utilisateur->id)}}" class="btn btn-info">Debannir</a></td>
								</tr>
							@endforeach
							</tbody>
						</table>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        $("#toggleVoirTypeOuvModal").on("click", function(e){
        	e.preventDefault();
        	$("#listerTypeOuvrierModal").modal();
        });
		$("#toggleTypeProjModal").on("click", function(e){
        	e.preventDefault();
        	$("#listerTypeProjetModal").modal();
        });       
		$("#toggleNewTypeProjModal").on("click", function(e){
			e.preventDefault();
			$("#CreerTypeProjetModal").modal();
		});
		$("#creerTypeProjetSubmit").on("click", function(e){
			e.preventDefault();
			$("#CreerTypeProjetModal").fadeOut();
			$("#creerTypeProjetForm").submit();
		});
		$("#creerTypeProjetFromModal").on("click", function(e){
			$("#CreerTypeProjetModal").modal();
		});
		$("#toggleNewTypeOuvModal").on("click", function(e){
			e.preventDefault();
			$("#CreerTypeOuvrierModal").modal();
		});
		$("#creerTypeOuvrierSubmit").on("click", function(e){
			e.preventDefault();
			$("#CreerTypeOuvrierModal").fadeOut();
			$("#creerTypeOuvrierForm").submit();
		});
		$("#creerTypeOuvrierFromModal").on("click", function(e){
			$("#CreerTypeOuvrierModal").modal();
		});
		$("#toggleVoirUtilisateurSignaleModal").on("click", function(e){
			e.preventDefault();
			$("#listerUtilisateursSignaleModal").modal();
		});
		$("#toggleVoirUtilisateurBannisModal").on("click", function(e){
			e.preventDefault();
			$("#listerUtilisateursBannisModal").modal();
		})
    </script>
@endsection