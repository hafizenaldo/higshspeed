<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HIGHSPEED</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="login/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
</head>
<body>
<div class="main">
<!-- Sign in Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{ asset('login/images/signin-image.jpg') }}" alt="sign in image"></figure>
                    <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Log in</h2>
                    <form method="POST" action="{{ route('login') }}" class="register-form" id="login-form">
                        @csrf

                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" required />
                        </div>

                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password" required />
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember" class="agree-term" />
                            <label for="remember" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                        </div>
                    </form>

                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    <!-- JS -->
    <script src="login/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('login/js/main.js') }}"></script>
</body>
</html>
