@extends('layouts.app')

@section('content')
<!--=====
    Intro Section
  -->
  <section id="intro">

    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">
            <?php $introCarousel = asset('templateFiles/img/intro-carousel/1.jpg'); ?>
          <div class="carousel-item active" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Vous apprehendez de construire ?</h2>
                <p>Pas de panique ! PFE est une plateforme qui est la specialement pour vous. Engagez le meilleur des entrepreneur ou creez votre propre equipe de construction en recherchant les ouvriers les plus competents dans tout domaine !</p>
                <a href="#contact" class="btn-get-started scrollto">Commencer</a>
              </div>
            </div>
          </div>
          <?php $introCarousel = asset('templateFiles/img/intro-carousel/2.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Recherchez du travail facilement !</h2>
                <p>plombier ? menuisier ? ou quelconque ouvrier dans le domaine de la construction ? PFE vous permettra de <strong>trouver plus facilement du travail </strong>.</br> Inscivez vous en tant que ouvrier </p>
                <a href="#contact" class="btn-get-started scrollto">Commencer</a>
              </div>
            </div>
          </div>
          <?php $introCarousel = asset('templateFiles/img/intro-carousel/3.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Soif de projets ?</h2>
                <p>Vous etes entrepreneur et vous voullez trouver des projets rapidement ?<strong> Rejoignez nous en vous inscrivant en tant que entrepreneur</strong></p>

                <a href="#contact" class="btn-get-started scrollto">Commencer</a>

              </div>
            </div>
          </div>
          <?php $introCarousel1 = asset('templateFiles/img/intro-carousel/4.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Soyez le meilleur !</h2>
                <p>Que vous soyez entrepreneur ou ouvrier, vos client pourront noter votre qualite de travail ! soyez le meilleur dans votre domaine pour augmenter votre reputation et apparaitre parmis les premiers lors des recherches</p>

              </div>
            </div>
          </div>
        <?php $introCarousel = asset('templateFiles/img/intro-carousel/5.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Attendez vous a des changements</h2>
                <p>Cette application est en constante evolution ! attendez vous a des outils de plus en plus performant pour vos projets !</p>

                
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--=====
      Featured Services Section
    -->
    <section id="featured-services">
      <div class="container">
        <div class="row">


          <div class="col-lg-6 box">
            <i class="ion-ios-bookmarks-outline"></i>
            <h4 class="title"><a href="">Un systeme de recherche performant</a></h4>
            <p class="description">Recherchez selon les criteres que vous voullez les meilleurs entrepreneur et/ou ouvriers du moment ! ayez confiance aux gens dont vous confiez votre projet !</p>
          </div>

          <div class="col-lg-6 box box-bg">
            <i class="ion-ios-stopwatch-outline"></i>
            <h4 class="title"><a href="">Plus de temps a perdre</a></h4>
            <p class="description">Vous n'aurez desormais plus de temps a perdre dans la recherche de gens competents pour votre projet. trouves les en quelques clics !</p>
          </div>

        </div>
      </div>
    </section><!-- #featured-services -->

    <!--=====
      Services Section
<<<<<<< HEAD

    -->


    <section id="services">

      <div class="container">

        <header class="section-header wow fadeInUp">
          <h3>Comment ca marche ?!</h3>
          <p>PFE est une application web qui permet de faciliter le contact entre le client, l'entrepreneur et les ouvriers.</p>

        </header>

        <div class="row">

          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-analytics-outline"></i></div>

            <h4 class="title"><a href="#inscription">Inscrivez vous</a></h4>
            <p class="description">inscrivez vous et joignez vous a une communaute de plus d'une centaine d'utilisateurs qui ont le meme but que vous : construire</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
            <h4 class="title"><a href="">Recherchez</a></h4>
            <p class="description">Recherchez ce dont vous avez besoin et contactez les selon differents criteres !</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-paper-outline"></i></div>
            <h4 class="title"><a href="">Demandez</a></h4>
            <p class="description">Vous etes clients ? demandez aux entrepreneurs/ouvriers de vous rejoindre dans votre projet ! ou bien entrepreneurs ? demandez aux ouvriers de faire partie de votre equipe !</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
            <h4 class="title"><a href="">Postulez</a></h4>
            <p class="description">Postulez aux differents offres emis par les entrepreneurs et trouvez plus facilement du travail</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-barcode-outline"></i></div>
            <h4 class="title"><a href="">Construisez</a></h4>
            <p class="description">Aboutissez vos projets de construction avec une equipe que vous aurez choisis avec soin !</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-people-outline"></i></div>
            <h4 class="title"><a href="">Aidez nous</a></h4>
            <p class="description">Donnez nous votre avis sur l'application et recommendez-nous des ameliorations. nous vous en serons reconnaissants</p>

          </div>

        </div>

      </div>
    </section><!-- #services -->

    <!--=====
      About Us Section
    -->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>A propos de nous !</h3>
          <p>Nous sommes une equipes de jeunes developpeur talentueux qui viennent tout droit de l'usthb et qui veullent trouver leur place dans le monde professionel...</p>
        </header>

        <div class="row about-cols">

          <div class="col-md-4 wow fadeInUp">
            <div class="about-col">
              <div class="img">
                <img src="{{asset('templateFiles/img/about-mission.jpg')}}" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
              </div>
              <h2 class="title"><a href="#">Notre mission</a></h2>
              <p>
                Aider les jeunes entrepreneurs et ouvriers qui debutent a trouver plus facilement de l'emploi et faciliter la recherche d'effectif pour les clients ayant un projet de construction
              </p>
            </div>
          </div>

          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="about-col">
              <div class="img">
                <img src="{{asset('templateFiles/img/about-plan.jpg')}}" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-list-outline"></i></div>
              </div>
              <h2 class="title"><a href="#">Notre Plan</a></h2>
              <p>
                Deployer aux utilisateurs des outils efficaces pour mener la mission a bien pour leur plus grand plaisir.
              </p>
            </div>
          </div>

          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
            <div class="about-col">
              <div class="img">
                <img src="{{asset('templateFiles/img/about-vision.jpg')}}" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-eye-outline"></i></div>
              </div>
              <h2 class="title"><a href="#">Notre vision</a></h2>
              <p>
                Le site web sera mis a jour regulierement pour au final etre l'outil indispensable aux entrepreneurs <strong> de tout domaine </strong> ! n'hesitez pas a nous suivre !
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #about -->
    <!--==========================
      Inscription Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Inscription</h3>
          <p>Vous vous etes decides ?! rejoignez nous en remplissant ce formulaire</p>
        </div>

        

        <div class="form">
          
          <form action="{{route('register')}}" method="POST" >
            {{csrf_field()}}
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="nom" class="form-control" id="nom" placeholder="Votre Nom" data-rule="minlen:3" data-msg="Veuillez rentrer au moins 3 caracteres" />
              </div>
               <div class="form-group col-md-6">
                <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Votre Prenom" data-rule="minlen:3" data-msg="Veuillez rentrer au moins 3 caracteres" />
              </div>
            </div>
            <div class = "form-row">
              <div class="form-group col-md-12">
                <input type="email" class="form-control" name="email" id="email" placeholder="Votre Email" data-rule="email" data-msg="Please enter a valid email" />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 form-group{{ $errors->has('dateNaiss') ? ' has-error' : '' }}">

                

                    <input id="dateNaiss" type="date" class="form-control" name="dateNaiss" value="{{ old('dateNaiss') }}" required autofocus>

                    @if ($errors->has('dateNaiss'))
                        <span class="help-block">
                            <strong>{{ $errors->first('dateNaiss') }}</strong>
                        </span>
                    @endif
              </div>
              <div class="col-md-6 form-group{{ $errors->has('numTel') ? ' has-error' : '' }}">
                

                
                    <input id="numTel" type="tel" class="form-control" placeholder="Numero de Telephone" name="numTel" value="{{ old('numTel') }}" required>

                    @if ($errors->has('numTel'))
                        <span class="help-block">
                            <strong>{{ $errors->first('numTel') }}</strong>
                        </span>
                    @endif

              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                 
                      <input id="password" type="password" placeholder="Mot de Passe" class="form-control" name="password" required>

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                 
              </div>
               <div class="col-md-6 form-group">
                    <input id="password-confirm" type="password" placeholder="Confirmer Votre Mot de Passe" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-row">
              <div class="col-md-4 form-group{{ $errors->has('wilaya') ? ' has-error' : '' }}">
                    <input id="wilaya" type="number" class="form-control" placeholder="Wilaya" name="wilaya" value="{{ old('wilaya') }}" required>

                    @if ($errors->has('wilaya'))
                        <span class="help-block">
                            <strong>{{ $errors->first('wilaya') }}</strong>
                        </span>
                    @endif
              </div>
              <div class="col-md-4 form-group{{ $errors->has('region') ? ' has-error' : '' }}">

                  
                      <input id="region" type="text" class="form-control" placeholder="Region" name="region" value="{{ old('region') }}" required>

                      @if ($errors->has('region'))
                          <span class="help-block">
                              <strong>{{ $errors->first('region') }}</strong>
                          </span>
                      @endif
                  
              </div>
               <div class="col-md-4 form-group{{ $errors->has('type') ? ' has-error' : '' }}">

                      <select name="type" id="type" class="form-control">
                              <option value="" disabled selected hidden>Type d'utilisateur</option>
                              <option value="Entrepreneur" id="entrepreneur">Entrepreneur </option>
                              <option value="Client" id="client">Client</option>
                              <option value="Ouvrier" id ="ouvrier">Ouvrier</option>
                      </select>
                      @if ($errors->has('type'))
                          <span class="help-block">
                              <strong>{{ $errors->first('type') }}</strong>
                          </span>
                      @endif
                </div>
            </div>

            <div id="Info_Ouvrier" class="collapse">
              <div class="form-row">
                  <div class="col-md-6 form-group{{ $errors->has('fonction') ? ' has-error' : '' }}">
                          <select name="fonction" id="fonction" class="form-control">
                                  @foreach($fonctions as $fonction)

                                  <option value="{{$fonction->designation}}" id="{{$fonction->designation}}">{{$fonction->designation}}</option>
                                  @endforeach
                          </select>
                          @if ($errors->has('fonction'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('fonction') }}</strong>
                              </span>
                          @endif

                      
                  </div>
                </div>
                  <div class="col-md-6 form-group{{ $errors->has('diplome') ? ' has-error' : '' }}">

                      
                          <input type="checkbox" name="diplome" id="diplome" />
                          <label for="diplome">Je suis diplome</label>
                          @if ($errors->has('fonction'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('diplome') }}</strong>
                              </span>
                          @endif
                        

                  </div>
                </div>
               
                    
                      <div class="text-center">
                          <button type="submit" class="btn btn-primary">
                              S'inscrire !
                          </button>
                      </div>
                    
               
          </form>
        </div>

      </div>
    </section><!-- #contact -->

    <section id="team" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Se connecter</h3>
          <p>Connectez vous pour pouvoir en profiter ! </p>
        </div>
        <div class="form" style="margin-left:  20%;">
          <form class="form-horizontal " method="POST" action="{{ route('login') }}">
                        {!! csrf_field() !!}
                      <div class="form-row">
                        <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adresse E-mail</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se rappeler de moi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div style="margin-left:35%;">
                                <button type="submit" class="btn btn-success">
                                    Login
                                </button>
                            </div>
                            <div style="margin-left:28%;">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
        </div>
    </section>
      

  </main>
  <script src="{{ asset('js/JQuery.js') }}"></script>
    <script href="{{ asset('css/Bootstrap/js/bootstrap.js') }}"></script>
<script>
    $(function(){
        $("#type").change(function(){
                if($("#type").val() === "Ouvrier")
                    $("#Info_Ouvrier").collapse("show");
                else
                    $("#Info_Ouvrier").collapse("hide");
            
                
        });
    });
</script>
@endsection