@extends('layouts.appConnected')

@section('content')
<div class="retouches">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Rechercher un ouvrier</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST"  action="{{route('doRecherche.ouvrier')}}">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="type" class="form-control">
                                            <option disabled hidden selected>Type de l'ouvrier</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->designation}}" id="{{$type->designation}}">{{$type->designation}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="nom" id="nom" placeholder="Nom de l'ouvrier" class="form-control" />
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="prenom" id="prenom" placeholder="Prenom de l'ouvrier" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                             <div class="form-group col-md-3">
                                <input type="checkbox" name="diplome" id="diplome" class="form-control" />
                                <label for="diplome" class="control-label">L'ouvrier doit etre diplome</label>
                              </div>
                            </div>
                            <div class="form-row">
                               
                                 <div class="form-group col-md-3">
                                    <input type="text" name="reputationMin" id="reputationMin" placeholder="Nombre d'etoiles minimal" class="form-control" />
                                </div>
                                 <div class="form-group col-md-3">
                                    <input type="text" name="reputationMax" id="reputationMax" placeholder="Nombre d'etoiles minimal" class="form-control" />
                                </div>
                                 <div class="form-group col-md-3">
                                    <input type="text" name="prixApproxMin" id="prixApproxMin" placeholder="Prix journalier minimal" class="form-control" />
                                </div>
                                 <div class="form-group col-md-3">
                                    <input type="text" name="prixApproxMax" id="prixApproxMax" class="form-control" placeholder = "Prix journalier maximal"/>
                                </div>
                            </div>  
                            <div class="form-row">
                               
                              <div class="form-group col-md-6">
                                  <input type="text" name="experienceMin" id="experienceMin" placeholder="Nombre d'attestations d'affiliation a la CNAS minimal" class="form-control" />
                              </div>
                               <div class="form-group col-md-6">
                                  <input type="text" name="experienceMax" id="experienceMax" placeholder="Nombre d'attestations d'affiliation a la CNAS maximal" class="form-control" />
                              </div>
                            
                            </div>    
                            <div class="form-row">  
                                 <div class="form-group col-md-6">
                                    <input type="text" name="wilaya" id="wilaya" placeholder="Wilaya" class="form-control" />
                                </div>           
                                 <div class="form-group col-md-6">
                                    <input type="text" name="region" id="region" placeholder="Region" class="form-control" />
                                </div> 
                            </div>
                            <div class="form-grop col-md-6 panel-center">
                                <input type="submit" value="Rechercher" class="btn btn-success btn-block" />
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ici, on affiche le resultat de la recherche, si il s'agit d'un get, on affichera tout simplement la liste total des projets -->
        @foreach($ouvriers as $ouvrier)
         <section id="services" class="resultats">
          <div class="container">

            <header class="section-header wow fadeInUp">
              <h3><a href="{{route('utilisateur.profil', $ouvrier->user->id)}}">{{$ouvrier->user->nom}} {{$ouvrier->user->prenom}}</a></h3>
              <p>{{$ouvrier->fonction}}</p>
              <!--On dois rajouter un truc pour les demandes d'emploi ici -->
            </header>

           <div class="row">

          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
            <h4 class="title"><a href="">{{$ouvrier->diplome ? 'Diplome' : 'Non Diplme'}}</a></h4>
            <p class="description">Cet ouvrier  {{$ouvrier->diplome ? 'est' : 'n\'est pas diplome' }} </p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
            <h4 class="title"><a href="">Nombre d'etoiles</a></h4>
            <p class="description">Les gens ont note cette ouvrier avec <span class="rateit" id="essai" data-rateit-value="{{$ouvrier->reputation}}" data-rateit-readonly="true" data-rateit-ispreset="true" ></span></p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-paper-outline"></i></div>
            <h4 class="title"><a href="">Prix Journalier</a></h4>
            <p class="description">Cet ouvrier compte moyennement {{$ouvrier->prixApprox}} par jour</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
            <h4 class="title"><a href="">Experience</a></h4>
            <p class="description">Cet ouvrier a {{$ouvrier->exeprience}} attestations d'affiliation a la CNAS</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-barcode-outline"></i></div>
            <h4 class="title"><a href="">Contactez le</a></h4>
            <p class="description">Appelez le  au {{$ouvrier->user->numTel}} ou envoyez lui une adresse e-mail au {{$ouvrier->user->email}}</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-people-outline"></i></div>
            <h4 class="title"><a href="">Localisation</a></h4>
            <p class="description">Cette ouvrier habite a {{$ouvrier->user->adresse}}-{{$ouvrier->user->region}}-{{$ouvrier->user->wilaya}}</p>
          </div>

        </div>

          </div>
        </section>
            

        @endforeach

    </div>
</div>
<script src="{{ asset('js/JQuery.js') }}"></script>
<script src="{{asset('rateit\jquery.rateit.js')}}"></script>
@endsection