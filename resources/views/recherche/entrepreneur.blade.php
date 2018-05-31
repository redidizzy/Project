@extends('layouts.appConnected')

@section('content')
<div class="retouches">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Rechercher un entrepreneur</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="GET"  action="{{route('doRecherche.entrepreneur')}}">
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <input type="text" name="nom" id="nom" placeholder="Nom de l'entrepreneur" class="form-control" />
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="prenom" id="prenom" placeholder="Prenom de l'entrepreneur" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="dispoMin" class="control-label">Disponible du </label>
                                <input type="date" name="dispoMin" id="dispoMin" placeholder="disponible du" class="form-control" />
                              </div>
                              <div class="form-group col-md-6">
                                <label for="dispoMax" class="control-label">Au </label>
                                  <input type="date" name="dispoMax" id="DispoMax" placeholder="Au" class="form-control" />
                              </div> 
                            </div>
                            <div class="form-row">
                               
                                 <div class="form-group col-md-3">
                                    <input type="text" name="reputationMin" id="reputationMin" placeholder="Nombre d'etoiles minimal" class="form-control" />
                                </div>
                                 <div class="form-group col-md-3">
                                    <input type="text" name="reputationMax" id="reputationMax" placeholder="Nombre d'etoiles maximal" class="form-control" />
                                </div>
                                 
                            </div>  
                            <div class="form-row">
                               <div class="form-group col-md-6">
                                  <input type="text" name="experienceMin" id="experienceMin" placeholder="Nombre d'attestations de bonne execution" class="form-control" />
                              </div>
                               <div class="form-group col-md-6">
                                  <input type="text" name="experienceMax" id="experienceMax" placeholder="Nombre d'attestations de bonne execution" class="form-control" />
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
        @foreach($entrepreneurs as $entrepreneur)
         <section id="services" class="resultats">
          <div class="container">

            <header class="section-header wow fadeInUp">
              <h3><a href="{{route('utilisateur.profil', $entrepreneur->user->id)}}">{{$entrepreneur->user->nom}} {{$entrepreneur->user->prenom}}</a></h3>
             
              <!--On dois rajouter un truc pour les offres d'emploi et pour une description bref de l'entreprise ici -->
            </header>

           <div class="row">

          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
            <h4 class="title"><a href="">Disponibilite</a></h4>
            <p class="description">L'entrepreneur est disponible :
              <ul>
                <li> Du : {{ $entrepreneur->dateDebutDispo }} </li>
                <li> Au : {{ $entrepreneur->dateFinDispo }} </li>
              </ul> 
            </p> 
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
            <h4 class="title"><a href="">Nombre d'etoiles</a></h4>
            <p class="description">Les gens ont note cette entrepreneur avec <span class="rateit" id="essai" data-rateit-value="{{$entrepreneur->finalRating()}}" data-rateit-readonly="true" data-rateit-ispreset="true" ></span></p>

          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-paper-outline"></i></div>
            <h4 class="title"><a href="">Materiel de l'entrepreneur</a></h4>
            <p class="description">{{$entrepreneur->materiel}}</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
            <h4 class="title"><a href="">Experience</a></h4>
            <p class="description">Cet entrepreneur a {{$entrepreneur->attestations->count()}} attestations d'affiliation a la CNAS</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-barcode-outline"></i></div>
            <h4 class="title"><a href="">Contactez le</a></h4>
            <p class="description">
              <ul>
                <li>Appelez le  au {{$entrepreneur->user->numTel}} </li>
                <li>envoyez lui une adresse e-mail au {{$entrepreneur->user->email}}</li>
              </ul>
              </p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-people-outline"></i></div>
            <h4 class="title"><a href="">Localisation</a></h4>
            <p class="description">Cette entrepreneur habite a {{$entrepreneur->user->adresse}}-{{$entrepreneur->user->region}}-{{$entrepreneur->user->wilaya}}</p>
          </div>

        </div>

          </div>
        </section>
            

        @endforeach

        <div class="links-pagination">{{ $links }} </div>

    </div>
</div>
<script src="{{ asset('js/JQuery.js') }}"></script>
<script src="{{asset('rateit\jquery.rateit.js')}}"></script>



@endsection