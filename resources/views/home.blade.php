@extends('layouts.appConnected')

@section('content')
    <!--=====
    Intro Section
  -->
  <section id="intro">

    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>
        
        <div class="carousel-inner" role="listbox">
		
		
		@if(Auth::user()->userable_type ==="Entrepreneur" )
			
		
		
            <?php $introCarousel = asset('templateFiles/img/intro-carousel/1.jpg'); ?>
          <div class="carousel-item active" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Mettez a jour votre profil !</h2>
                <p>Ajoutez, modifiez vos informations personnelles et proffessionnelles ici !</p>

                <a href="#" class="btn-get-started scrollto">Editer Profil</a> 
              </div>
            </div>
          </div>
		 
          <?php $introCarousel = asset('templateFiles/img/entre_client_ouvrier/im5.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Etes vous en manque de main d'oeuvre ?</h2>
                <p>maçon ? charpentier ? ou quelconque ouvriers dans le domaine de la construction ? PFE vous permettra de <strong>trouver plus facilement des ouvriers </strong>.Vous pourrez meme poster des offres d'emploi.</p>
                <a href="#inscription" class="btn-get-started scrollto">Rechercher</a>
              </div>
            </div>
          </div>
		  <?php $introCarousel = asset('templateFiles/img/intro-carousel/2.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
			  <h2>Soif de projets ?</h2>
                <p>Vous etes entrepreneur et vous voullez trouver des projets rapidement ? c'est simple ! PFE vous dispose d'un systeme de recherche de projet efficace qui vous permettra de trouver les projets les plus interessent selon vos critères</p>

                <a href="#" class="btn-get-started scrollto">Trouver un projet</a>
                

              </div>
            </div>
          </div>
		  <?php $introCarousel = asset('templateFiles/img/entre_client_ouvrier/im4.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Soyez le meilleur !</h2>
                <p>Vos client pourront noter votre qualite de travail ! soyez le meilleur dans votre domaine pour augmenter votre reputation et apparaitre parmis les premiers lors des recherches ! </p>

              </div>
            </div>
          </div>
		  @elseif(Auth::user()->userable_type ==="Client")
		  
			  
		  
			   <?php $introCarousel = asset('templateFiles/img/intro-carousel/1.jpg'); ?>
          <div class="carousel-item active" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
               <h2>Mettez a jour votre profil !</h2>
                <p>Ajoutez, modifiez vos informations personnelles et proffessionnelles ici !</p>

                <a href="#" class="btn-get-started scrollto">Editer Profil</a> 
              </div>
            </div>
          </div>
		  <?php $introCarousel = asset('templateFiles/img/entre_client_ouvrier/im5.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Vous apprehendez de construire ?</h2>
                <p>Pas de panique ! PFE est une plateforme qui est la specialement pour vous. Engagez le meilleur des entrepreneurs!</p>
                <a href="#inscription" class="btn-get-started scrollto">Trouver entrepreneur</a>
              </div>
            </div>
          </div>
          <?php $introCarousel = asset('templateFiles/img/intro-carousel/2.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                 <h2>Vous recherchez une equipe de travail ?</h2>
                <p>Avec PFE vous pouvez creer votre propre equipe de construction en recherchant les ouvriers les plus competents dans tout domaine !</p>
                <a href="#inscription" class="btn-get-started scrollto">Trouver ouvriers</a>
              </div>
            </div>
          </div>
		  <?php $introCarousel = asset('templateFiles/img/entre_client_ouvrier/im4.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Votre avis compte !</h2>
                <p>Partagez avec nous votre avis sur la qualité de travail de nos entrepreneurs et ouvriers. </p>

                <a href="#featured-services" class="btn-get-started scrollto">Noter</a>

              </div>
            </div>
          </div>
		  
		  @else
		
          <?php $introCarousel = asset('templateFiles/img/intro-carousel/1.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
			  <h2>Mettez a jour votre profil !</h2>
                <p>Ajoutez, modifiez vos informations personnelles et proffessionnelles ici !</p>

                <a href="#" class="btn-get-started scrollto">Editer Profil</a>
                
              </div>
            </div>
          </div>
		  <?php $introCarousel = asset('templateFiles/img/intro-carousel/2.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Recherchez-vous du travail?!</h2>
                <p>plombier ? menuisier ? ou quelconque ouvrier dans le domaine de la construction ? <strong>PFE</strong> vous permettra de trouver plus facilement ce qui vous convient .Vous pourrez poster des demandes d'emploi ou meme rechercher des projets ne necessitant pas d'entrepreneur.</p>
                <a href="#" class="btn-get-started scrollto">Trouver</a>

              </div>
            </div>
          </div>
		  <?php $introCarousel = asset('templateFiles/img/entre_client_ouvrier/im4.jpg'); ?>
          <div class="carousel-item" style="background-image: url('{{$introCarousel}}');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Soyez le meilleur !</h2>
                <p>Vos client pourront noter votre qualite de travail ! soyez le meilleur dans votre domaine pour augmenter votre reputation et apparaitre parmis les premiers lors des recherches ! </p>
              </div>
            </div>
          </div>
		  @endif
		  
		   <?php $introCarousel = asset('templateFiles/img/intro-carousel/4.jpg'); ?>
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
@endsection
