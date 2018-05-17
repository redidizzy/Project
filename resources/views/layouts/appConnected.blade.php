<!-- Ce template est destine aux gens connectes -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PFE</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">


  <!-- Favicons -->
  <link href="{{asset('templateFiles/img/favicon.png')}}" rel="icon">
  <link href="{{asset('templateFiles/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{asset('templateFiles/lib/bootstrap/css/bootstrap.css?version=1')}}" rel="stylesheet">


    <!-- Styles -->

    <link href="{{ asset('css/additional.css?version=1.1') }}" rel="stylesheet" />

  <!-- Libraries CSS Files -->
  <link href="{{asset('templateFiles/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('templateFiles/lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('templateFiles/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('templateFiles/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('templateFiles/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
  <!-- select2 -->
  <link href="{{asset('select2/css/select2.min.css')}}" rel="stylesheet" />

  <!-- Main Stylesheet File -->
  <link href="{{asset('templateFiles/css/style.css')}}" rel="stylesheet">

  <link href="{{asset('rateit/rateit.css')}}" rel="stylesheet">


  <!-- =======================================================
    Theme Name: BizPage
    Theme URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>
  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid flexed">
      
    
        <div id="logo" class="pull-left">
          <h1><a href="#intro" class="scrollto">ECOntact</a></h1>
          
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
        </div>
        <div id="recherche" class="col-md-4">
        <form method="POST" class="form-inline" action="{{route('recherche.rapide')}}">
                {{csrf_field()}}
                <input type="text" name="recherche"  class="form-control" />

                <input type="submit" value="Rechercher" class = "btn btn-success"/>

          </form>
        </div>
       
        <nav id="nav-menu-container">

          <ul class="nav-menu">
              <li><a href="{{route('home')}}">Accueil</a></li>
              <li><a href="{{route('utilisateur.profil', Auth::user()->id) }}">Mon profil</a></li>
            @if(Auth::user()->userable_type === "Entrepreneur")
              <li><a href="{{route('offres.index', Auth::user()->id)}}">Mes offres</a></li>
              <li class="menu-has-children"><a href="#">Recherche Avancee</a>
                <ul>
                  <li><a href="{{route('recherche.ouvrier')}}">Rechercher Ouvrier</a></li>
                  <li><a href="{{route('recherche.projet')}}">Rechercher Projet</a></li>
                </ul>
              </li> 
            @elseif(Auth::user()->userable_type === "Ouvrier")
            

              <li><a href="{{route('demandes.index', Auth::user()->id)}}">Demandes D'Emplois</a></li>

              <li class="menu-has-children"><a href="#">Recherche Avancee</a>
                <ul>
                  <li><a href="{{route('recherche.projet')}}">Rechercher Projet</a></li>
                  <li><a href="{{route('recherche.entrepreneur')}}">Rechercher Entrepreneur</a></li>
                </ul>
              </li> 

            @else
              <li> <a href="{{route('projets.index', Auth::user()->id)}}">Projets</a></li>
              <li class="menu-has-children"><a href="#">Recherche Avancee</a>
                <ul>
                  <li><a href="{{route('recherche.ouvrier')}}">Rechercher Ouvrier</a></li>
                  <li><a href="{{route('recherche.entrepreneur')}}">Rechercher Entrepreneur</a></li>
                </ul>
              </li> 
            @endif
            <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
               Deconnexion
              </a>    
              <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            </li>
          </ul>
          
        </nav><!-- #nav-menu-container -->
      
    </div>
  </header><!-- #header -->
  @yield('content')
  

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>ECOntact</h3>
            <p>Nous sommes ravis de pouvoir aider le peuple a aboutir leur projets personnel, suivez nous ! vous ne le regretterez pas </p>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Liens utiles</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Acceuil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#about">A propos de nous</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#services">Comment ca marche</a></li>
			  <li> <i class="ion-ios-arrow-right"></i> <a href="{{route('admin.index')}}">Acceder a l'espace admin </a></li>
              
            </ul>
          </div>

          <div class="col-lg-5 col-md-6 footer-contact">
            <h4>Contactez nous</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Telephone:</strong> 0542658943 - 0658778845<br>
              <strong>Email:</strong> z.rediane24@gmail.com - tina98dib@gmail.com<br>
            </p>

            <div class="social-links text-center">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>

            </div>

          </div>


        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>PFE</strong>. Tout Droits Reserves
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
        -->
        Best <a href="https://bootstrapmade.com/">Bootstrap Templates</a> by BootstrapMade
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{asset('templateFiles/lib/jquery/jquery.min.js')}}"></script>
<script src="{{asset('templateFiles/lib/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/superfish/hoverIntent.js')}}"></script>
  <script src="{{asset('templateFiles/lib/superfish/superfish.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/waypoints/waypoints.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/isotope/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/lightbox/js/lightbox.min.js')}}"></script>
  <script src="{{asset('templateFiles/lib/touchSwipe/jquery.touchSwipe.min.js')}}"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{asset('templateFiles/contactform/contactform.js')}}"></script>

  <!-- Template Main Javascript File -->
  <script src="{{asset('templateFiles/js/main.js')}}"></script>
 <script src="{{asset('js/customize.js') }}"></script> 
 <script type="text/javascript">
  var APP_URL = {!! json_encode(config('app.url')) !!}
</script> 

 @yield("script")


</body>
</html>
