<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Personal Budget Tracker</title>

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
        /* Specify background image properties */
        background-size: cover;
        /* Cover the entire viewport */
        background-position: center;
        /* Center the background image */
        background-repeat: no-repeat;
        /* Do not repeat the background image */
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-box {
        width: 600px; /* Increase width */
        max-width: 100%;
        padding: 20px; /* Add padding if necessary */
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 30px; /* Add padding inside the card */
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
            <div class="content-top-agile p-20 pb-0">
                <h2 class="login-box-msg">User Register</h2>
</div>
                <form class="post-form" name="UserRegister" id="UserRegister" action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" />
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email"/>
                                <p></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile No. <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" maxlength="10" id="mobile" name="mobile" placeholder="Mobile No."/>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password"  placeholder="Password"/>
                                <p></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Budget Limit Amount <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  id="budget_limit" name="budget_limit" placeholder="Budget Limit Amount"/>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Duration</label>
                            <select name="duration" id="duration" class="form-control">
                                <option value="" disabled selected>Select Duration</option>
                                <option value="Month">Month</option>
                                <option value="Year">Year</option>
                            </select>
                            <p></p>
                        </div>

                        
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                       </div>
                       <div class="col-md-4">
                       <button type="submit" class="btn btn-primary btn-block">Submit</button>
                       </div>
                       <div class="col-md-4">
                    
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
    <script>
        $('#UserRegister').submit(function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '{{ route("user-register") }}',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    if (response['status'] == true) {
                        window.location.href = "{{ route('user-login') }}";
                    } else {
                        var errors = response['errors'];
                        $.each(errors, function (key, value) {
                            var elementId = key.replace(/\./g, '_');
                            $('#' + elementId).next('p').addClass('text-danger').html(value[0]);
                        });
                    }
                },
                error: function () {
                    console.log('Something went wrong');
                }
            });
        });

        function toggleButtonState() {
            var phoneNumber = $('#mobile').val();
            phoneNumber = phoneNumber.replace(/[^0-9]/g, '');
            phoneNumber = phoneNumber.slice(0, 10);
            $('#mobile').val(phoneNumber);
        }
        $('#mobile').on('input', function () {
            toggleButtonState();
        });
        $(document).ready(function () {
            $('#name').on('input', function () {
                $('#name').siblings('p').removeClass('text-danger').html('');
            });
            $('#last_name').on('input', function () {
                $('#last_name').siblings('p').removeClass('text-danger').html('');
            });
            $('#username').on('input', function () {
                $('#username').siblings('p').removeClass('text-danger').html('');
            });
            $('#email').on('input', function () {
                $('#email').siblings('p').removeClass('text-danger').html('');
            });
            $('#mobile').on('input', function () {
                $('#mobile').siblings('p').removeClass('text-danger').html('');
            });
            $('#password').on('input', function () {
                $('#password').siblings('p').removeClass('text-danger').html('');
            });
            $('#budget_limit').on('input', function () {
                $('#budget_limit').siblings('p').removeClass('text-danger').html('');
            });
            $('#duration').on('input', function () {
                $('#duration').siblings('p').removeClass('text-danger').html('');
            });
        });
    </script>
</body>

</html>
