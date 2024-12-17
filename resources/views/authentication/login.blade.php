<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <title>CDA - CMS</title>
    <!-- <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/icons/cda-logo.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/authentication.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <style>
        /* Full-screen overlay */
        #loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            /* Make sure it’s above other content */
        }

        /* Loader styling */
        .loader {
            border: 6px solid #f3f3f3;
            /* Light grey */
            border-top: 6px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }


        /* Loader spin animation */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css') }}">

    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div id="loader-overlay" style="display: none;">
        <div class="loader"></div>
    </div>

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Login basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <div  class="brand-logo">
                                    <img src="{{asset('app-assets/images/icons/cda-logo.png')}}" alt="">
                                </div>

                                <h4 class="card-title mb-1">Welcome to CDA! 👋</h4>
                                <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
                                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
                              <!-- Login Form -->
                              <form class="auth-login-form mt-2" action="" method="POST">
    <div class="mb-1">
        <label for="login-email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="login-email" name="login-email" placeholder="email"
            aria-describedby="login-email" tabindex="1" autofocus required />
    </div>

    <div class="mb-1">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="login-password">Password <span class="text-danger">*</span></label>
            <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                <small>Forgot Password?</small>
            </a>
        </div>
        <div class="input-group input-group-merge form-password-toggle">
            <input type="password" class="form-control form-control-merge" id="login-password" name="login-password"
                tabindex="2" placeholder="password" aria-describedby="login-password" required />
            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
        </div>
    </div>

    <div class="mb-1">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember-me" tabindex="3" />
            <label class="form-check-label" for="remember-me"> Remember Me </label>
        </div>
    </div>
    <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
</form>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm" action="" method="POST">
                    <div class="mb-3">
                        <label for="forgot-password-email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="forgot-password-email" name="forgot-password-email"
                            placeholder="email" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="loader-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.8); z-index:9999;">
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>


                                <!-- <p class="text-center mt-2">
                                    <span>New on our platform?</span>
                                    <a href="auth-register-basic.html">
                                        <span>Create an account</span>
                                    </a>
                                </p> -->

                                <!-- <div class="divider my-2">
                                    <div class="divider-text">or</div>
                                </div>

                                <div class="auth-footer-btn d-flex justify-content-center">
                                    <a href="#" class="btn btn-facebook">
                                        <i data-feather="facebook"></i>
                                    </a>
                                    <a href="#" class="btn btn-twitter white">
                                        <i data-feather="twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-google">
                                        <i data-feather="mail"></i>
                                    </a>
                                    <a href="#" class="btn btn-github">
                                        <i data-feather="github"></i>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <!-- /Login basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/pages/auth-login.js')}}"></script>
    <!-- END: Page JS-->
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script>
    $(document).ready(function() {
    // Feather icons initialization
    if (feather) {
        feather.replace({ width: 14, height: 14 });
    }

    // Retrieve and set the checkbox state on page load
    const rememberMeCheckbox = $('#remember-me');
    const emailInput = $('#login-email');
    const passwordInput = $('#login-password');

    // Load saved data from localStorage
    if (localStorage.getItem('rememberMe') === 'true') {
        rememberMeCheckbox.prop('checked', true);
        emailInput.val(localStorage.getItem('loginEmail') || '');
        passwordInput.val(localStorage.getItem('loginPassword') || '');
    }

    // Handle form submission
    $('.auth-login-form').on('submit', function(e) {
        e.preventDefault();

        let email = emailInput.val();
        let password = passwordInput.val();
        let isValid = true;

        $('.form-control').removeClass('is-invalid');

        if (email === '' || !validateEmail(email)) {
            emailInput.addClass('is-invalid');
            isValid = false;
        }
        if (password === '') {
            passwordInput.addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        // Store the checkbox state in localStorage
        if (rememberMeCheckbox.is(':checked')) {
            localStorage.setItem('rememberMe', 'true');
            localStorage.setItem('loginEmail', email);
            localStorage.setItem('loginPassword', password);
        } else {
            localStorage.removeItem('rememberMe');
            localStorage.removeItem('loginEmail');
            localStorage.removeItem('loginPassword');
        }

        let formData = {
            email: email,
            password: password,
        };

        $.ajax({
            url: '{{ route("admin.login.submit") }}',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'You have been successfully logged in.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    setTimeout(function() {
                        window.location.href = response.redirect_url;
                    }, 2000); // Wait for 2 seconds before redirecting
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    let errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>'; // Collect all validation errors
                    });
                    Swal.fire({
                        title: 'Validation Error!',
                        html: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });

    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    $(document).ajaxStart(function() {
        $('#loader-overlay').show();
    });
    $(document).ajaxStop(function() {
        $('#loader-overlay').hide();
    });

    $('#forgotPasswordForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            }
        },
        submitHandler: function(form) {
            const email = $('#forgot-password-email').val(); // Get email value

            // AJAX request
            $.ajax({
                url: '{{ route('admin.password.email') }}', // Your route
                type: 'POST',
                data: { email: email },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for security
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    $('#forgotPasswordModal').modal('hide'); // Hide modal on success
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred. Please try again later.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message; // Custom error message
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
});

  </script>

</body>
<!-- END: Body-->

</html>