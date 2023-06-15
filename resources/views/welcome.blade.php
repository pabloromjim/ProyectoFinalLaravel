<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>3 en raya</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="css/landing/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/landing/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="css/landing/boxicons/css/boxicons.min.css" rel="stylesheet">


    <!-- Main CSS File -->
    <link href="css/landing/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->

    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="#">3 en ra<span>ya</span></a></h1>

            <nav id="navbar" class="navbar">
                <ul>
                    @if (Route::has('login'))

                    @if (Auth::check())
                    <a href="{{ url('/home') }}" class="mx-lg-4">Jugar</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    @else
                    <li><a href="{{ url('/login') }}">Iniciar Sesion</a></li>
                    <li><a href="{{ url('/register') }}">Registrarte</a></li>
                    @endif
                    @endif

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->


    <section id="hero" class="d-flex align-items-center">

        <div class="video-background">
            <div class="video-wrap">
                <div id="video">
                    <video id="bdvid" autoplay loop muted playsinline>
                        <source src="css/landing/tic.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </section>
    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4 class="title"><a href="">Juega en línea</a></h4>
                            <p class="description">Desafía a tus amigos a una partida o juega contra jugadores aleatorios de todo el
                                mundo. ¡Demuestra tus habilidades estratégicas y conquista la tabla de clasificación!</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon"><i class="bi bi-emoji-laughing"></i></div>
                            <h4 class="title"><a href="">Diversión para todas las edades:</a></h4>
                            <p class="description">Nuestro juego es perfecto para jugadores de todas las edades. Ya sea que seas un
                                experto en estrategia o estés buscando una forma divertida de pasar el tiempo, ¡aquí encontrarás lo que
                                necesitas!</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4 class="title"><a href="">Comunidad amigable</a></h4>
                            <p class="description">Únete a nuestra comunidad de jugadores apasionados y comparte estrategias, consejos
                                y trucos. Conoce a nuevos amigos y desafíalos a emocionantes partidas.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon"><i class="bx bx-world"></i></div>
                            <h4 class="title"><a href="">Competencias y clasificaciones</a></h4>
                            <p class="description">Participa en torneos y competencias periódicas para medir tus habilidades contra
                                los mejores jugadores. ¡Sube en la clasificación y obtén recompensas especiales!</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Featured Services Section -->



        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Estadistica Online</h2>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <h2>Podras ver las estadisticas de los juegos y usuarios en tiempo real.</h2>
                        <section id="counts" class="counts">
                            <div class="container" data-aos="fade-up">

                                <div class="row d-flex flex-row justify-content-evenly">

                                    @foreach ($datos as $dato)
                                    <div class="col-lg-3 col-md-6  mb-sm-5">
                                        <div class="count-box">
                                            <i class=" bi bi-people-fill"></i>
                                            <span data-purecounter-start="0" data-purecounter-end="{{ $dato->total_users }}" data-purecounter-duration="1" class="purecounter"></span>
                                            <p>Usuarios Registrados</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 ">
                                        <div class="count-box">
                                            <i class="bi bi-trophy-fill"></i>
                                            <span data-purecounter-start="0" data-purecounter-end="{{ $dato->total_games }}" data-purecounter-duration="1" class="purecounter"></span>
                                            <p>Partidas Jugadas</p>
                                        </div>
                                    </div>
                                </div> -->
                                @endforeach

                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </section>








    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h4>¿Estás listo para poner a prueba tus habilidades estratégicas en el 3 en raya? Regístrate ahora mismo y
                            comienza a disfrutar de la diversión ilimitada que ofrece nuestro sitio web. ¡La victoria te espera!</h4>
                        <a href="{{ url('/register') }}" class="btn btn-primary">Registrate</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-top">
            <div class="container">
                <div class="row text-center">

                    <div class="col-md-6 col-sm-9 footer-contact">
                        <h3>3 en raya<span>.</span></h3>
                        <p>
                            Calle Falsa 123 <br>
                            Sevilla<br>
                            España<br><br>
                            <strong>Phone:</strong> 000 000 000<br>
                            <strong>Email:</strong> pablo.romero-jimenez@iesruizgijon.com<br>
                        </p>
                    </div>



                    <div class="col-md-6 col-sm-9 footer-links">
                        <h4>Nuestras Redes Sociales</h4>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </footer><!-- End Footer -->



    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



    <!-- Vendor JS Files -->
    <script src="css/landing/purecounter/purecounter_vanilla.js"></script>

    <script src="css/landing/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="css/landing/glightbox/js/glightbox.min.js"></script>

    <script src="css/landing/swiper/swiper-bundle.min.js"></script>



    <!-- Template Main JS File -->
    <script src="css/landing/main.js"></script>

</body>

</html>