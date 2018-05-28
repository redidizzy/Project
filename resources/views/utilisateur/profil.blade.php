
@extends('layouts.appConnected')

@section('content')

    <div class="retouches" id="csrf" data-csrf="{{csrf_field()}}">
        <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-success">

                    <div class="panel-heading" id="heading-styling" data-id="{{$user->id}}">
                    <p>Information General</p> <div id="signaler"><a href="#" id="toggleSignaler">Signaler</a></div>
                    </div>

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
                            @if($user->userable_type == "Client")
                            <a href="#" class="btn btn-info" id="togglePasswordChange">Changer mot de passe</a>
                            @endif 
                        </div>

                        <?php
                        }
                        ?>
                        @if(Auth::user()->id != $user->id && ($user->userable_type == "Entrepreneur" || $user->userable_type == "Ouvrier"))
                         <div class="text-center">Noter: <span class="rateit" id="rateitAjax" data-rateit-value= "{{$noteUtilisateur}}" > </span> </div>
                         @endif
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
                                        <li>Reputation : <span class="rateit" id="note" data-rateit-value="{{$note}}" data-rateit-readonly="true" data-rateit-ispreset="true" ></span></li>
                                        <li>Experience : <a href="#" id="toggleVoirAttestations">{{$user->userable->attestations->count()}} attestations {{$user->userable_type =="Entrepreneur" ? 'de bonne execution' : ($user->userable_type=="Ouvrier" ? 'd\'affiliation a la CNAS' : '')}}</a></li>
                                    
                                        @if($user->userable_type === "Entrepreneur")
                                            <li>Nom de l'entreprise : {{$user->userable->nom_entreprise}}</li>
                                            <li>Description de l'entreprise: {{$user->userable->description_entreprise}}</li>
                                            <li>Vous etes actuellement disponible du : {{$user->userable->dateDebutDispo}} au : {{$user->userable->dateFinDispo}}</li>
                                            <li>Materiel : {{$user->userable->materiel}} </li>
                                        @else
                                            <li>Diplomes : <a href="#" id ="toggleVoirDiplomes">{{$user->userable->diplomes->count()}}(Afficher)</a></li>
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
                                        <a href="#" class="btn btn-success btn-block" id = "toggleAjouterAttestationEntrepreneur">Importer attestation de bonne execution </a>
                                        <a href="#" id="toggleInfoEntrModal"class="btn btn-success btn-block">Rajouter des informations sur l'entreprise</a>
                                        <a href="#" id="toggleDispoEntrepreneur"class="btn btn-success btn-block">Changer Disponibilite</a>
                                    @else
                                        <a href="#" id ="toggleAjouterDiplome"class="btn btn-success btn-block">Ajouter Diplome</a>
                                        <a href="#" id="toggleChangerProfession" class="btn btn-success btn-block">Changer de Profession</a>
                                        <a href="#" id="toggleChangerPrix"class="btn btn-success btn-block">Changer de Prix Approximatif</a>
                                        <a href="#" class="btn btn-success btn-block" id = "toggleAjouterAttestationEntrepreneur">Importer attestation d'affiliation a la CNAS </a>

                                    @endif

                                    <a href="#" class="btn btn-success btn-block" id="togglePasswordChange">Changer mot de passe</a>

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
            <form action="{{route('AjouterAttestation', $user->userable)}}" method="POST" id="AjouterAttestationEntrepreneurForm" enctype="multipart/form-data">
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
    @if($user->userable_type == "Entrepreneur" or $user->userable_type == "Ouvrier")
    <div class="modal fade" id ="voirAttestations" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">voir les {{$user->userable->attestations->count()}} attestations</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            @foreach($user->userable->attestations as $attestation)
            
                <img src="{{asset($attestation->photo_url)}}" style="width:100px;" />
            @endforeach
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div> 

    <!-- pour l'ouvrier -->
    <div class="modal fade" id ="ajouterDiplome" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Importer un diplome</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{route('ajouteDiplome', $user->userable)}}" method="POST" id="ajouterDiplomeForm" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group col-md-10">
                    <input type="file" name="diplome" id="diplome"  class="form-control"/>
                    <input type="text" name="titre" id="titre"  class="form-control" placeholder="Titre du diplome"/>
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" id="ajouterDiplomeSubmit" >Confirmer</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <div class="modal fade" id ="changerProfession" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Changer de profession</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{route('changerProfession')}}" method="POST" id="changerProfessionForm" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group col-md-10">
                    <select id="types" name="profession" class="form-control">
                    @foreach($types as $type)
                        <option value="{{$type->designation}}">{{$type->designation}}</option>
                    @endforeach
                    </select>
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" id="changeProfessionSubmit" >Confirmer</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <div class="modal fade" id ="changerPrix" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Changer de prix journalier</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{route('changerPrix')}}" method="POST" id="changerPrixForm" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group col-md-10">
                    <input type="number" name="prix" placeholder="votre nouveau prix journalier" class="form-control" />
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" id="changerPrixSubmit" >Confirmer</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    @if($user->userable_type == "Ouvrier")
    <div class="modal fade" id ="voirDiplomes" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">voir les {{$user->userable->diplomes->count()}} attestations</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            @foreach($user->userable->diplomes as $diplome)
            
                <img src="{{asset($diplome->photoDiplome)}}" style="width:300px;" />
            @endforeach
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    
    @endif 
    @endif
    @if($user->id != Auth::user()->id)
    <div class="modal fade" id ="signalerUtilisateur" role="dialog">
     <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Signaler l'utilisateur</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{route('utilisateur.signaler', $user->id)}}" method="POST" id="signalerForm" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT" />
                <div class="form-group col-md-10">
                   <textarea class="form-control" id="motif" name="motif" placeholder="Veuillez indiquer le motif de votre signalement"></textarea>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" id="signalerSubmit" >Confirmer</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    @endif
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
        $("#toggleAjouterAttestationEntrepreneur").on("click", function(e){
            e.preventDefault();
            $("#AjouterAttestationEntrepreneur").modal();
        });
        $("#toggleVoirAttestations").on("click", function(e){
            e.preventDefault();
            $("#voirAttestations").modal();
        });
        $("#ajouterDiplomeSubmit").on("click", function(e){
            e.preventDefault();
            $("#ajouterDiplomeForm").submit();
        });
         $("#toggleAjouterDiplome").on("click", function(e){
            e.preventDefault();
            $("#ajouterDiplome").modal();
        });
         $("#toggleVoirDiplomes").on("click", function(e){
            e.preventDefault();
            $("#voirDiplomes").modal();
        });
         $("#toggleChangerProfession").on("click", function(e){
            e.preventDefault();
            $("#changerProfession").modal()
         });
         $("#changeProfessionSubmit").on("click", function(e){
            e.preventDefault();
            $("#changerProfession").fadeOut();
            $("#changerProfessionForm").submit();
         });
        $("#toggleChangerPrix").on("click", function(e){
            e.preventDefault();
            $("#changerPrix").modal()
         });
         $("#changerPrixSubmit").on("click", function(e){
            e.preventDefault();
            $("#changerPrix").fadeOut();
            $("#changerPrixForm").submit();
         });
         $("#toggleSignaler").on("click", function(e){
          e.preventDefault();
          $("#signalerUtilisateur").modal();
         });
         $("#signalerSubmit").on("click", function(e){
            e.preventDefault();
            $("#signalerUtilisateur").fadeOut();
            $("#signalerForm").submit();
         });
         $.ajaxSetup({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
         $("#rateitAjax").bind('rated reset', function(event, value){
            if(!value)
              value = 0;
            var data = {
              "newValue" : value
            };
            var user_id = $("#heading-styling").attr("data-id");
            $.post(APP_URL+"/ajax/rate/"+user_id, data, function(d){
              $("#note").rateit("value", d);
            });
         });
    </script>
     <script src="{{asset('rateit\jquery.rateit.js')}}"></script>
@endsection