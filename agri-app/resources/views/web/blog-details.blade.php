<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Blog Details - AgriCulture Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Marcellus:wght@400&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- font awesome CDN --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

</head>

<body class="blog-details-page">

    <header id="header" class="header d-flex align-items-center position-relative">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/img/logo.png') }}" alt="AgriCulture">
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
                    @if (Auth::check())
                        <!-- User is logged in -->
                        <li>
                        <li><a href="{{ url('/profile') }}">Profile</a></li>
                        <form action="{{ route('logout') }}" method="GET" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger ">Logout</button>
                        </form>
                        </li>
                    @else
                        <!-- User is not logged in -->
                        <li><a href="{{ url('/login') }}">Login/SignUp</a></li>
                    @endif
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade"
            style="background-image: url('{{ asset('assets/img/page-title-bg.webp') }}');">
            <div class="container position-relative">
                <h1>Blog Details</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, sed.</p>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">Blog Details</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Blog Details Section -->
                    <section id="blog-details" class="blog-details section">
                        <div class="container">

                            <article class="article">

                                <h2 class="title">{{$blog->title}}</h2>

                                <div class="meta-top">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                href="blog-details.html">{{$blog->user->full_name}}</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="blog-details.html"><time
                                                    datetime="2020-01-01">{{$blog->post_date}}</time></a></li>

                                    </ul>
                                </div><!-- End meta top -->

                                <div class="content">
                                    <p>
                                        {{$blog->description}}
                                    </p>

                                </div><!-- End post content -->

                                <div class="meta-bottom">
                                    <i class="bi bi-folder"></i>
                                    <ul class="cats d-f">
                                        <li><a href="#">{{$blog->category->name}}</a></li>
                                        <li><i class="fa-regular fa-comment btn"></i>
                                            <a href="#comment-form">Comments</a>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-heart btn like-btn {{ auth()->check() && $blog->isLikedBy(auth()->user()) ? 'text-danger' : '' }}"
                                                data-blog-id="{{ $blog->id }}"></i>
                                            <a href="javascript:void(0)">
                                                <span class="like-count"
                                                    id="like-count-{{ $blog->id }}">{{ $blog->likes->count() }}</span>
                                                Likes
                                            </a>
                                        </li>

                                    </ul>
                                </div><!-- End meta bottom -->

                            </article>

                        </div>
                    </section><!-- /Blog Details Section -->

                    <!-- Blog Comments Section -->
                    <section id="blog-comments" class="blog-comments section">

                        <div class="container">
                            <h4 class="comments-count">{{ $blog->comments->count() }}
                                Comment{{ $blog->comments->count() !== 1 ? 's' : '' }}
                            </h4>
                            @if($blog->comments->isEmpty())
                                <p>No comments yet. Be the first to comment!</p>
                            @else
                                @foreach($blog->comments as $comment)
                                    <div class="comment mb-4">
                                        <div class="d-flex">
                                            <div>
                                                <h5>
                                                    <a href="#">{{ $comment->name }}</a>
                                                    <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a>
                                                </h5>
                                                <time datetime="{{ $comment->created_at->toDateString() }}">
                                                    {{ $comment->created_at->format('d M, Y') }}
                                                </time>
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- End comment #1 -->
                </div>

                </section><!-- /Blog Comments Section -->

                <!-- Comment Form Section -->
                <section id="comment-form" class="comment-form section">
                    <div class="container">

                        <form action="{{ route('blogs.comments.store', $blog->id) }}" method="post">
                            @csrf
                            <h4>Post Comment</h4>
                            <p>Your email address will not be published. Required fields are marked * </p>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input name="name" type="text" class="form-control" placeholder="Your Name*">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input name="email" type="text" class="form-control" placeholder="Your Email*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <textarea name="comment" class="form-control"
                                        placeholder="Your Comment*"></textarea>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Post Comment</button>
                            </div>

                        </form>
                    </div>
                </section>
                <!-- /Comment Form Section -->
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
                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a
                            href="https://themewagon.com">ThemeWagon</a>
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
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function () {

            const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

            $('.like-btn').click(function () {
                const blogId = $(this).data('blog-id');
                const likeBtn = $(this);

                if (!isLoggedIn) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Required',
                        text: 'Please login first to like the post.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                const url = "{{ route('blogs.toggleLike', ['blog' => '__BLOG_ID__']) }}".replace('__BLOG_ID__', blogId);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        const likeCountSpan = $('#like-count-' + blogId);
                        likeCountSpan.text(response.count);

                        if (response.liked) {
                            likeBtn.addClass('text-danger');
                        } else {
                            likeBtn.removeClass('text-danger');
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                });
            });
        });
    </script>


    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
            });
        </script>
    @endif


    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
            });
        </script>
    @endif

</body>

</html>