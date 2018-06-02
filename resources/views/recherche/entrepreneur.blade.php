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
                                    <select name="reputationMin" id="reputaionMin" class="form-control">
                                      <option disabled selected hidden>Nombre d'etoiles minimal</option>
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                 <div class="form-group col-md-3">
                                   <select name="reputationMax" id="reputaionMax" class="form-control">
                                    <option disabled selected hidden>Nombre d'etoiles maximal</option>
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                 
                            </div>  
                            <div class="form-row">
                               <div class="form-group col-md-6">
                                  <input type="number" name="experienceMin" id="experienceMin" placeholder="Nombre d'attestations de bonne execution" class="form-control" />
                              </div>
                               <div class="form-group col-md-6">
                                  <input type="number" name="experienceMax" id="experienceMax" placeholder="Nombre d'attestations de bonne execution" class="form-control" />
                              </div>
                             
                            
                            </div>    
                             <div class="form-row">
                              <div class="col-md-6 form-group{{ $errors->has('wilaya') ? ' has-error' : '' }}">
                                    <select id="wilaya" class="form-control" name="wilaya" required>
                                      <option value="0" selected hidden disabled>Choisir une wilaya</option>
                                    @foreach(config('variables.wilayas') as $nwil=>$wil)
                                        <option value="{{$nwil}}" id="{{$nwil}}">{{$nwil}}-{{$wil}}</option>
                                    @endforeach
                                    </select>
                                    @if ($errors->has('wilaya'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('wilaya') }}</strong>
                                        </span>
                                    @endif
                              </div>
                              <div class="col-md-6 form-group{{ $errors->has('region') ? ' has-error' : '' }}">

                                  
                                      <select name="region" id="region" class="form-control">
                                        <option value="0" selected hidden disabled>Choisir Une commune</option>
                                      </select>

                                      @if ($errors->has('region'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('region') }}</strong>
                                          </span>
                                      @endif
                                  
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-5">
                                <select name="tri" class="form-control">
                                  <option disabled hidden selected> Trier par : </option>
                                  <option value = "experience" id ="budget">experience</option>
                                  <option value = "reputation" id="reputation">Reputation</option> 
                                  <option value = "nom" id="nom" >Nom</option>
                                  <option value = "prenom" id="prenom" >Prenom</option>
                                  <option value= "dateDebutDispo" id="dateDispoMin">Date de Disponibilite Minimal</option>
                                  <option value = "dateFinDispo" id="dateDispoMax">Date de Disponibilite Maximal</option>

                                </select>
                              </div>
                              <div class="form-group col-md-5">
                                <select name="asc" class="form-control">
                                  <option value = "1" id ="budget" selected>Ascendant</option>
                                  <option value = "0" id="reputation">Descendant</option> 
                                </select>
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
                <li> Du : {{ $entrepreneur->dateDebutDispo->format('d/m/Y') }} </li>
                <li> Au : {{ $entrepreneur->dateFinDispo->format('d/m/Y') }} </li>
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