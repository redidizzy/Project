@extends('layouts.appConnected')

@section('content')
    <!--=====
    Intro Section
  -->
  <section id="intro">

    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>
        /** 
          *@todo des carousels differents pour chaque type d'utilisateur
        */ 
        <div class="carousel-inner" role="listbox">
            <?php $introCarousel = asset('templateFiles/img/intro-carousel/1.jpg'); ?>
          <div class="carousel-item active" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Vous apprehendez de construire ?</h2>
                <p>Pas de panique ! PFE est une plateforme qui est la specialement pour vous. Engagez le meilleur des entrepreneur ou creez votre propre equipe de construction en recherchant les ouvriers les plus competents dans tout domaine !</p>
                <a href="#inscription" class="btn-get-started scrollto">Commencer</a>
              </div>
            </div>
          </div>
          <?php $introCarousel = asset('templateFiles/img/intro-carousel/2.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Recherchez du travail facilement !</h2>
                <p>plombier ? menuisier ? ou quelconque ouvrier dans le domaine de la construction ? PFE vous permettra de <strong>trouver plus facilement du travail </strong>.Vous pourrez poster des demandes d'emploi ou meme rechercher des projets ne necessitant pas d'entrepreneur.</p>
                <a href="#inscription" class="btn-get-started scrollto">Commencer</a>
              </div>
            </div>
          </div>
          <?php $introCarousel = asset('templateFiles/img/intro-carousel/3.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Soif de projets ?</h2>
                <p>Vous etes entrepreneur et vous voullez trouver des projets rapidement ? c'est simple ! PFE vous dispose d'un systeme de recherche de projet efficace qui vous permettra de trouver les projets les plus interessent selon vos criteres</p>

                <a href="#featured-services" class="btn-get-started scrollto">Commencer</a>

              </div>
            </div>
          </div>
          <?php $introCarousel1 = asset('templateFiles/img/intro-carousel/4.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Soyez le meilleur !</h2>
                <p>Que vous soyez entrepreneur ou ouvrier, vos client pourront noter votre qualite de travail ! soyez le meilleur dans votre domaine pour augmenter votre reputation et apparaitre parmis les premiers lors des recherches ! </p>

                <a href="#featured-services" class="btn-get-started scrollto">Commencer</a>

              </div>
            </div>
          </div>
        <?php $introCarousel = asset('templateFiles/img/intro-carousel/5.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Attendez vous a des changements</h2>
                <p>Cette application est en constante evolution ! attendez vous a des outils de plus en plus performant pour vos projets !</p>

                <a href="#featured-services" class="btn-get-started scrollto">Commencer</a>

                

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
@endsection
