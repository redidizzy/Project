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
							<li><a href="#" style="color : rgb(120, 150, 120);">-Voir tout les utilisateurs</a></li>
							<li><a href="#" style="color : rgb(120, 150, 120);">-Voir les utilisateurs signales</a></li>
						</ul>
					</li>
					<li> <a href="#">Gerer les Types de projets</a>
						<ul>
							<li><a href="#" style="color : rgb(120, 150, 120);">-Voir les types de projets existants</a></li>
							<li><a href="#" style="color : rgb(120, 150, 120);">-Creer un nouveau type de projet</a></li>
						</ul>
					</li>
					<li> <a href="#">Gerer les Types d'ouvriers</a>
						<ul>
							<li><a href="#" style="color : rgb(120, 150, 120);">-Voir les types de projets existants</a></li>
							<li><a href="#" style="color : rgb(120, 150, 120);">-Creer un nouveau type de projet</a></li>
						</ul>
					</li>
				</ul>
				<div class="row">
					<div class="col-md-4">
						
					</div>
				</div>
			
			
			</div>
		</div>
		</div>
	</div>
	
@endsection