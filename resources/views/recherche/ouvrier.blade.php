@extends('layouts.appConnected')

@section('content')
<div class="retouches">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Rechercher un ouvrier</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="GET"  action="{{route('doRecherche.ouvrier')}}">
                           
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
                                 <div class="form-group col-md-3">
                                    <input type="number" name="prixApproxMin" id="prixApproxMin" placeholder="Prix journalier minimal en DA" class="form-control" />
                                </div>
                                 <div class="form-group col-md-3">
                                    <input type="number" name="prixApproxMax" id="prixApproxMax" class="form-control" placeholder = "Prix journalier maximal en DA"/>
                                </div>
                            </div>  
                            <div class="form-row">
                               
                              <div class="form-group col-md-6">
                                  <input type="number" name="experienceMin" id="experienceMin" placeholder="Nombre d'attestations d'affiliation a la CNAS minimal" class="form-control" />
                              </div>
                               <div class="form-group col-md-6">
                                  <input type="number" name="experienceMax" id="experienceMax" placeholder="Nombre d'attestations d'affiliation a la CNAS maximal" class="form-control" />
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
                                  <option value = "experience" id ="budget">Experience</option>
                                  <option value = "reputation" id="reputation">Reputation</option> 
                                  <option value = "prixApprox" id="prixApprox">Prix journalier</option> 
                                  <option value = "nom" id="nom" >Nom</option>
                                  <option value = "prenom" id="prenom" >Prenom</option>
                                  <option value = "nbDiplome" id="nbDiplome" >Nombre de diplomes</option>

                                </select>
                              </div>
                              <div class="form-group col-md-5">
                                <select name="asc" class="form-control">
                                  <option value = "1" id ="budget">Ascendant</option>
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
            <h4 class="title"><a href="">{{$ouvrier->diplomes->first() ? 'Diplome' : 'Non Diplome'}}</a></h4>
            <p class="description">Cet ouvrier  a {{$ouvrier->diplomes->count()}} diplomes</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
            <h4 class="title"><a href="">Nombre d'etoiles</a></h4>
            <p class="description">Les gens ont note cette ouvrier avec <span class="rateit" id="essai" data-rateit-value="{{$ouvrier->finalRating()}}" data-rateit-readonly="true" data-rateit-ispreset="true" ></span></p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-paper-outline"></i></div>
            <h4 class="title"><a href="">Prix Journalier</a></h4>
            <p class="description">Cet ouvrier compte moyennement {{$ouvrier->prixApprox}} par jour</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
            <h4 class="title"><a href="">Experience</a></h4>
            <p class="description">Cet ouvrier a {{$ouvrier->attestations->count()}} attestations d'affiliation a la CNAS</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-barcode-outline"></i></div>
            <h4 class="title"><a href="">Contactez le</a></h4>
            <p class="description">Appelez le  au {{$ouvrier->user->numTel}} ou envoyez lui une adresse e-mail au {{$ouvrier->user->email}}</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-people-outline"></i></div>
            <h4 class="title"><a href="">Localisation</a></h4>
            <p class="description">Cette ouvrier habite a {{$ouvrier->user->adresse}}-{{$ouvrier->user->region}}-{{config('variables.wilayas.'.$ouvrier->user->wilaya)}}</p>
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