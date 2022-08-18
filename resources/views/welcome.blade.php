<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Chispots</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
        rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css" rel="stylesheet" />
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"></script>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Chispots
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/dashboard/">
                                Home
                            </a>
                            <a class="dropdown-item" href="{{'/usuarios/'.Auth::user()->id}}">
                                Mi cuenta
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <header class="masthead text-white text-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1 class="mb-5">"Cuidamos de tu salud con la mejor atención médica"</h1>
                </div>

            </div>
        </div>
    </header>
    <!-- Icons Grid-->
    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex"><i class="icon-screen-desktop m-auto text-primary"></i>
                        </div>
                        <h3>Tecnología</h3>
                        <p class="lead mb-0">Contamos con la mejor tecnología del mercado</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex"><i class="icon-layers m-auto text-primary"></i></div>
                        <h3>Administración</h3>
                        <p class="lead mb-0">Aseguramos la información del paciente</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                        <div class="features-icons-icon d-flex"><i class="icon-check m-auto text-primary"></i></div>
                        <h3>Calidad</h3>
                        <p class="lead mb-0">Brindamos la mejor atención del cliente</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Image Showcases-->
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-12 text-center  order-lg-2 text-dark ">
                    <h3>Equipos especializados</h3>
                    <!-- Carousel wrapper -->
                    <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>

                        <!-- Inner -->
                        <div class="carousel-inner">
                            <!-- Single item -->
                            <div class="carousel-item active" data-mdb-interval="5000">
                                <img src="assets/slide2.png" class="d-block w-100" alt="..." />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Áreas</h5>
                                    <p>Contamos con áreas de calidad, limpias y con mantenimiento constante.</p>
                                </div>
                            </div>

                            <!-- Single item -->
                            <div class="carousel-item" data-mdb-interval="5000">
                                <img src="assets/slide2.png" class="d-block w-100" alt="..." />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Radiografías</h5>
                                    <p>Contamos con los mejores equipos para la generación y revisión de exámenes,
                                        radiografías, etc</p>
                                </div>
                            </div>

                            <!-- Single item -->
                            <div class="carousel-item" data-mdb-interval="5000">
                                <img src="assets/slide2.png" class="d-block w-100" alt="..." />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Personal médico</h5>
                                    <p>Nuestro personal médico se encuentra capacitado para realizar un trabajo efectivo
                                        para el paciente.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Inner -->

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample"
                            data-mdb-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample"
                            data-mdb-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- Carousel wrapper -->

                    <!-- Masthead-->


                </div>
            </div>
        </div>
    </section>
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6 map-container order-lg-2 text-white showcase-img">
                    <iframe style="height: 500px; width:100%"
                        src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        frameborder="0" style="border:0" allowfullscreen class=""></iframe>
                </div>

                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Visítanos</h2>
                    <p class="lead mb-0">Nuestro horario de atención es de 24 horas para cualquier caso médico, las
                        visitas se reciben desde las 8:00am a 8:00pm de Lunes a Domingo </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials-->
    <!-- Call to Action-->
    <section class="call-to-action text-white text-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">


            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"><a href="#!">Acerca</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Contacto</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Terminos de uso</a></li>
                        <li class="list-inline-item">⋅</li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">© Chispots 2021. All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item mr-3">
                            <a href="#!"><i class="fab fa-facebook fa-2x fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item mr-3">
                            <a href="#!"><i class="fab fa-twitter-square fa-2x fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!"><i class="fab fa-instagram fa-2x fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>