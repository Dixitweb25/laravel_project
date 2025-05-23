<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - AgriApp Dashboard</title>
    <link href="{{asset('admin_assets/css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .login-dash {
            background: #4d6570;
            background: linear-gradient(185deg, rgba(77, 101, 112, 1) 0%, rgba(67, 79, 69, 1) 50%, rgba(184, 174, 72, 1) 100%);
        }
    </style>
</head>

<body class="login-dash">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 mt-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><span
                                            class="h1 text-danger fst-italic fw-bolder border-bottom border-5 border-info">A</span>dmin
                                        Login
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.login.submit') }}" novalidate>
                                        @csrf

                                        {{-- Email field --}}
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" type="text" placeholder="name@example.com"
                                                value="{{ old('email') }}" required />
                                            <label for="email">Email address</label>
                                            @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Password field --}}
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" type="password" placeholder="Password"
                                                required />
                                            <label for="password">Password</label>
                                            @error('password')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="#">Forgot Password?</a>
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>

                                {{-- <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="{{asset('admin_assets/js/scripts.js')}}"></script>

    {{-- session using sweetalert --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: true
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: true
            });
        </script>
    @endif
</body>

</html>