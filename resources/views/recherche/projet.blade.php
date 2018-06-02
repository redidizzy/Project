@extends('layouts.appConnected')

@section('content')
<div class="retouches">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Rechercher un projet</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="GET"  action="{{route('doRecherche.projet')}}">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="type" class="form-control">
                                            <option disabled hidden selected>Type du projet</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->designation}}" id="{{$type->designation}}">{{$type->designation}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="nom" id="nom" placeholder="Nom du proprietaire du projet" class="form-control" />
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="prenom" id="prenom" placeholder="Prenom du proprietaire du projet" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <input type="number" name="superficieMin" id="superficieMin" placeholder="Superficie minimal du terrain" class="form-control" />
                                </div>
                                 <div class="form-group col-md-3">
                                    <input type="number" name="superficieMax" id="superficieMax" placeholder="Superficie maximal du terrain" class="form-control" />
                                </div>
                                 <div class="form-group col-md-3">
                                    <input type="number" name="budgetMin" id="budgetMin" placeholder="Budget minimal du proprietaire" class="form-control" />
                                </div>
                                 <div class="form-group col-md-3">
                                    <input type="number" name="budgetMax" id="budgetMax" placeholder="Budget maximal du proprietaire" class="form-control" />
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
                            <div class="form-grop col-md-6 panel-center">
                                <input type="submit" value="Rechercher" class="btn btn-success btn-block" />
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ici, on affiche le resultat de la recherche, si il s'agit d'un get, on affichera tout simplement la liste total des projets -->
        @foreach($projets as $projet)
         <section id="services" class="resultats">
          <div class="container">

            <header class="section-header wow fadeInUp">
              <h3>Projet de {{$projet->type->designation}}</h3>
              <p>{{$projet->description}}</p>
            </header>

            <div class="row">

              <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
                <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
                <h4 class="title"><a href="">Superficie</a></h4>
                <p class="description">La superificie de ce projet est de {{$projet->superficie}} Km`</p>
              </div>
              <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
                <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
                <h4 class="title"><a href="">Budget</a></h4>
                <p class="description">Le budget du proprietaire pour ce projet s'eleve a {{$projet->budget}} Dinars Algeriens</p>
              </div>
              <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
                <div class="icon"><i class="ion-ios-paper-outline"></i></div>
                <h4 class="title"><a href="">Adresse</a></h4>
                <p class="description">{{$projet->adresse}}-{{$projet->region}}-{{config('variables.wilayas.'.$projet->wilaya)}}</p>
              </div>
              <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
                <h4 class="title"><a href="">Delai</a></h4>
                <p class="description">La date limite de ce projet est le : {{$projet->delai}}</p>
              </div>
              <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
                <div class="icon"><i class="ion-ios-barcode-outline"></i></div>
                <h4 class="title"><a href="">Contacter le proprietaire</a></h4>
                <p class="description">Appelez le proprietaire du projet au {{$projet->client->user->numTel}} ou envoyez lui une adresse e-mail au {{$projet->client->user->email}}</p>
              </div>
              <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
                <div class="icon"><i class="ion-ios-people-outline"></i></div>
                <h4 class="title"><a href="">Preferences</a></h4>
                <p class="description">Ce projet est a la recherche de preference {{$projet->necessiteEntrepreneur ? 'd\'entrepreneur' : 'de main d\'oeuvre'}}</p>
              </div>

            </div>

          </div>
        </section>
            

        @endforeach
        <div class="links-pagination">{{ $links }} </div>
    </div>
</div>
@endsection