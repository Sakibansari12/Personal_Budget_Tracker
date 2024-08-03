<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Personal Budget Tracker</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .login-page {
        /*background-image: url('admin/assets/images/background/848.jpg');*/
        /* Specify background image properties */
        background-size: cover;
        /* Cover the entire viewport */
        background-position: center;
        /* Center the background image */
        background-repeat: no-repeat;
        /* Do not repeat the background image */
    }

    .card-primary.card-outline {
        border-top: 5px solid #3a47d5;
    }

    .form-control:focus {
        border-color: #b62a2a;
    }

    a {
        color: #3a47d5;
    }

    a:hover {
        color: #3a47d5;
    }

    .btn-primary {
        color: #fff;
        background-color: #3a47d5;

        border-color: #3a47d5;
        box-shadow: none;
    }
  
    .btn-primary:hover {
        color: #fff;
        background-color: #00d2ff;
        border-color: #00d2ff;
        box-shadow: none;
    }

    .icheck-primary>input:first-child:checked+label::before {
        background-color: #3a47d5;
        border-color: #3a47d5;
    }
</style>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline">
            <div class="card-body">
                <p class="login-box-msg">User Login</p>
                <form method="post" action="{{ route('ck_login') }}">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    @csrf
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                    <div class="input-group mb-3">
                        <input type="text" name="email" id="email" class="form-control" placeholder="username/email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/assets/js/adminlte.min.js') }}"></script>
</body>

</html>
