
@extends('layouts.appConnected')

@section('content')

    <div class="retouches">
        <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-success">

                    <div class="panel-heading">Information General</div>

                    <div class="panel-body">
                        <div class="row">
                            <ul class="col-md-8">
                                
                                <li>nom : {{$user->nom}}</li>
                                <li>prenom : {{$user->prenom}}</li>
                                <li>date de naissance : {{$user->dateNaiss}} </li>
                                <li>email : {{$user->email}} </li>
                                <li>wilaya : {{config('variables.wilayas.'.$user->wilaya)}}</li>
                                <li>region : {{$user->region}}</li>
                                <li>addresse : {{$user->adresse}}</li>
                                <li>numero de telephone : {{$user->numTel}}</li> 
                                <li>Type d'utilisateur : {{$user->userable_type}}</li>
                            </ul>
                            <div class="col-md-4 col-md-offset-2">
                                <img src="{{asset($user->photoProfil)}}" style="height : 200px; " />
                            </div>
                        </div>
                        
                        <?php if(Auth::user()->id === $user->id )
                        {
                        ?>
                        <div class="text-center">
                            <a href="{{route('utilisateur.edit')}}" class="btn btn-success">Editer</a>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
                @if($user->userable_type != "Client")
                    <div class="panel-center row">
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">Informations professionnel</div>

                                <div class="panel-body">
                                    <ul>    
                                        <li>Reputation : {{$user->userable->reputation}}</li>
                                        <li>Experience : {{$user->userable->experience}} attestations</li>
                                    
                                        @if($user->userable_type === "Entrepreneur")
                                            <li>Nom de l'entreprise : {{$user->userable->nom_entreprise}}</li>
                                            <li>Description de l'entreprise: <div class="well">{{$user->userable->description_entreprise}}</div></li>
                                            <li>Vous etes actuellement disponible du : {{$user->userable->dateDebutDispo}} au : {{$user->userable->dateFinDispo}}</li>
                                            <li>Materiel : <div class="well">{{$user->userable->materiel}} </div></li>
                                        @else
                                            <li>Diplomes : a faire</li>
                                            <li>Profession : {{$user->userable->fonction}}</li>
                                            <li>Prix Journalier Moyen : {{$user->userable->prixApprox}}</li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if($user->id == Auth::user()->id)
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">Boite a outils</div>
                                <div class="panel-body text-center">

                                    @if($user->userable_type === "Entrepreneur")
                                        <a href="#" class="btn btn-primary btn-block">Importer attestation de bonne execution </a>
                                        <a href="#" id="toggleInfoEntrModal"class="btn btn-warning btn-block">Rajouter des informations sur l'entreprise</a>
                                        <a href="#" id="toggleDispoEntrepreneur"class="btn btn-danger btn-block">Changer Disponibilite</a>
                                    @else
                                        <a href="#" class="btn btn-primary btn-block">Ajouter Diplome</a>
                                        <a href="#" class="btn btn-warning btn-block">Changer de Profession</a>
                                        <a href="#" class="btn btn-danger btn-block">Changer de Prix Approximatif</a>

                                    @endif

                                    <a href="#" class="btn btn-info btn-block" id="togglePasswordChange">Changer mot de passe</a>
                                </div>

                            </div>
                        </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>

    <div class="modal fade" id ="ajouterEntrepriseInfoModal" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Rajouter des informations sur l'entreprise</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{route('ajouterInfoEntreprise', $user->userable)}}" method="POST" id="infoEntrepriseForm">
                {{csrf_field()}}
                <div class="form-group col-md-10">
                    <input type="text" placeholder="Nom de l'entreprise" name="nom_entreprise" id="nom_entreprise"  class="form-control" value="{{$user->userable->nom_entreprise}}"/>
                </div>
                <div class="form-group col-md-10">
                    <textarea placeholder="Materiel dont vous disposez" name="materiel" class="form-control">{{$user->userable->materiel}}</textarea>
                </div>
                <div class="form-group col-md-10">
                    <textarea placeholder="Description Bref de l'entreprise et de ses employes" name ="description_entreprise"class="form-control">{{$user->userable->description_entreprise}}</textarea>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" id="submitEntrepriseInfos" >Confirmer</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div> 
    <div class="modal fade" id ="EntrepriseDispoModal" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Changer la disponibilite</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{route('changerDispoEntrepreneur', $user->userable)}}" method="POST" id="dispoEntrepriseForm">
                {{csrf_field()}}
                <div class="form-group col-md-10">
                    <label class="control-label" for="dateDebutDispo">Vous etes disponible du :</label>
                    <input type="date" name="dateDebutDispo" id="dateDebutDispo"  class="form-control" value="{{$user->userable->dateDebutDispo}}"/>
                </div>
                <div class="form-group col-md-10">
                    <label for="dateFinDispo" class="control-label">Au</label>
                    <input type="date" name="dateFinDispo" id="dateFinDispo" class="form-control" value ="{{$user->userable->dateFinDispo}}" />
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" id="submitEntrepriseDispo" >Confirmer</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div> 
    <div class="modal fade" id ="ChangerMotDePassModal" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Changer de mot de passe</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{route('changePassword', $user->userable)}}" method="POST" id="ChangerMotDePassForm">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <input type="password" name="oldPassword" id="oldPassword"  class="form-control" placeholder="Veuillez indiquer votre ancien mot de passe" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder ="Indiquer votre nouveau mot de passe" />
                    </div>
                    <div class="form-group col-md-5">
                        <input type="password" name="rnewPassword" id="rnewPassword" class="form-control" placeholder ="Veuillez confirmer votre nouveau mot de passe" />
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" id="submitPassword" >Confirmer</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    <div class="modal fade" id ="AjouterAttestationEntrepreneur" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Importer une Attestation de Bonne Execution</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{route('AjouterAttestationEntrepreneur', $user->userable)}}" method="POST" id="AjouterAttestationEntrepreneurForm">
                {{csrf_field()}}
                <div class="form-group col-md-10">
                    <input type="file" name="attestation" id="attestation"  class="form-control"/>
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" id="AjouterAttestationEntrepreneurSubmit" >Confirmer</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div> 
@endsection
 @section("script")   
    <script>
        $("#toggleInfoEntrModal").on("click", function(e){
            e.preventDefault();
            $("#ajouterEntrepriseInfoModal").modal();
        });
        $("#submitEntrepriseInfos").on("click", function(e){
            e.preventDefault();
            $("#ajouterEntrepriseInfoModal").fadeOut();
            $("#infoEntrepriseForm").submit();
        });
        $("#submitEntrepriseDispo").on("click", function(e){
            e.preventDefault();
            $("#EntrepriseDispoModal").fadeOut();
            $("#dispoEntrepriseForm").submit();
        });
        $("#toggleDispoEntrepreneur").on("click", function(e){
            e.preventDefault();
            $("#EntrepriseDispoModal").modal();
        });
        $("#togglePasswordChange").on("click", function(e){
            e.preventDefault();
            $("#ChangerMotDePassModal").modal();
        });
        $("#submitPassword").on("click", function(e){
            e.preventDefault();
            $("#ChangerMotDePassModal").fadeOut();
            $("#ChangerMotDePassForm").submit();
        });
        $("#AjouterAttestationEntrepreneurSubmit").on("click", function(e){
            e.preventDefault();
            $("#AjouterAttestationEntrepreneur").fadeOut();
            $("#AjouterAttestationEntrepreneurForm").submit();
        });
        $("#toggleAjouterAttestationEntrepreneurSubmit").on("click", function(e){
            e.preventDefault();
            $("#AjouterAttestationEntrepreneur").modal();
        });
    </script>
@endsection