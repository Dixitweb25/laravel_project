<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>AgriCulture Blog</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Marcellus:wght@400&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: AgriCulture
    * Template URL: https://bootstrapmade.com/agriculture-bootstrap-website-template/
    * Updated: Aug 07 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center position-relative border-bottom">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="assets/img/logo.png" alt="AgriCulture">
                <!-- <h1 class="sitename">AgriCulture</h1>  -->
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/services') }}">Our Services</a></li>
                    <li><a href="{{ url('/testimonials') }}">Testimonials</a></li>
                    <li><a href="{{ url('/blogs') }}">Blog</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    {{-- signup form --}}

    <main class="main py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bg-success text-white text-center rounded-top-4">
                            <h3 class="mb-0 text-light">Create Account</h3>
                        </div>

                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('users.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="full_name" class="form-label"><b>Full Name</b></label>
                                    <input type="text" class="form-control" id="full_name" name="full_name"
                                        placeholder="Enter your full name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label"><b>Email address</b></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block"><b>Gender</b></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                            value="Male" required>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                            value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="other"
                                            value="Other">
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="mobile_no" class="form-label"><b>Mobile Number</b></label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                        placeholder="Enter your phone number" required>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label"><b>Location</b></label>
                                    <input type="text" class="form-control" id="location" name="location"
                                        placeholder="Enter your location" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label"><b>Password</b></label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Create a password" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">Sign Up</button>
                                </div>
                                <hr class="my-4">
                                <p class="text-center mb-0">
                                    Already have an account?
                                    <a href="{{ url('/login') }}" class="text-success text-decoration-none">Login
                                        here</a>
                                </p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>


    <footer id="footer" class="footer dark-background">

        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span class="sitename">AgriCulture</span>
                        </a>
                        <div class="footer-contact pt-3">
                            <p>A108 Adam Street</p>
                            <p>New York, NY 535022</p>
                            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                            <p><strong>Email:</strong> <span>info@example.com</span></p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Terms of service</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">Web Development</a></li>
                            <li><a href="#">Product Management</a></li>
                            <li><a href="#">Marketing</a></li>
                            <li><a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Hic solutasetp</h4>
                        <ul>
                            <li><a href="#">Molestiae accusamus iure</a></li>
                            <li><a href="#">Excepturi dignissimos</a></li>
                            <li><a href="#">Suscipit distinctio</a></li>
                            <li><a href="#">Dilecta</a></li>
                            <li><a href="#">Sit quas consectetur</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Nobis illum</h4>
                        <ul>
                            <li><a href="#">Ipsam</a></li>
                            <li><a href="#">Laudantium dolorum</a></li>
                            <li><a href="#">Dinera</a></li>
                            <li><a href="#">Trodelas</a></li>
                            <li><a href="#">Flexo</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="copyright text-center">
            <div
                class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

                <div class="d-flex flex-column align-items-center align-items-lg-start">
                    <div>
                        © Copyright <strong><span>MyWebsite</span></strong>. All Rights Reserved
                    </div>

                </div>

                <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>

            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>