<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="identy - Your #1 for identity verification and BVN-related services, cable TV subscriptions (DSTV, GOTV, & STARTIMES), electricity bill payments, recharge card, and data printing.">
    <meta name="keywords"
        content="identy - Your #1 for identity verification and BVN-related services, cable TV subscriptions (DSTV, GOTV, & STARTIMES), electricity bill payments, recharge card, and data printing.">
    <!-- SITE TITLE -->
    <title>AA Taskar Bege</title>
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/index/bootstrap/css/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/index/fonts/font-awesome.min.css') }}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('assets/index/fonts/themify-icons.css') }}">
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="{{ asset('assets/index/css/materialdesignicons-min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/index/owlcarousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/index/owlcarousel/css/owl.theme.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/index/css/animate.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('assets/index/css/magnific-popup.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/index/css/style-three.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/index/css/style-three11.css') }}">
    <!-- Favicon -->
    <link href="{{ asset('assets/index/img/icon/LOGO.jpg') }}" rel="icon" type="image">
    <!-- HTML5 shim and Respond.js for IE8 support -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-offset="80">
    <!-- Particles -->
    <div id="particles-js"></div>

    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="logo-container">
            <img src="{{ asset('assets/index/img/icon/LOGO.jpg') }}" alt="AA TASKAR BEGE Logo" class="logo">
            <h1>AA TASKAR BEGE</h1>
        </div>
        <nav>
            <ul class="nav">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </nav>
        <div class="home_btn">
            <a href="#" class="btn btn-secondary">Register</a>
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <div class="about_us section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                    <p>
                        <a href="#" target="_blank">Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All Rights Reserved AA Taskar Bege.
                        </a>
                    </p>
                    <p>
                        <a href="https://zepaapi.com/" target="_blank">Design By &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            zepa API.
                        </a>
                    </p>
                    <p>Thank you for choosing us for your business</p>
                    <div class="footer_profile">
                        <ul class="list-unstyled d-flex justify-content-center">
                            <li><a href="#" target="_blank"><i class="bi bi-facebook"></i></a></li>
                            <li><a href="#" target="_blank"><i class="bi bi-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="bi bi-instagram"></i></a></li>
                            <li>
                                <a href="https://wa.me/+2348030564012?text=Hello%20identy%20I%20Want%20To%20Know%20More%20About%20Your%20Platform.%20Please%20Help%20Me.%20Thank%20You.!"
                                    target="_blank">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/index/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/index/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets//index/js/modernizr-2.8.3.min.js') }}"></script>
    <script src="{{ asset('assets/index/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/index/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/index/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/index/js/countdown.js') }}"></script>
    <script src="{{ asset('assets/index/js/particles.min.js') }}"></script>
    <script src="{{ asset('assets/index/js/app.js') }}"></script>
    <script src="{{ asset('assets/index/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/index/js/scrolltopcontrol.js') }}"></script>
    <script src="{{ asset('assets/index/js/scripts.js') }}"></script>
</body>

</html>
