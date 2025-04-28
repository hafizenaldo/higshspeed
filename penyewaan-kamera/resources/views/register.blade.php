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
    <link rel="stylesheet" href="login/css/style.css">
</head>
<body>

<div class="main">
<!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Register</h2>
                    <form method="POST" action="/register" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Full Name" required />
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" required />
                        </div>

                        <div class="form-group">
                            <label for="nohp"><i class="zmdi zmdi-phone"></i></label>
                            <input type="text" name="nohp" id="nohp" placeholder="No Handphone" required />
                        </div>

                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password" required />
                        </div>

                        <div class="form-group">
                            <label for="confirm_password"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required />
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                        </div>
                    </form>

                    <!-- Tambahkan ini -->
                    <div class="text-center mt-3">
                        <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
                    </div>

                </div>
                <div class="signup-image">
                    <figure><img src="login/images/hs.jpg" alt="sign up image"></figure>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JS -->
<script src="login/vendor/jquery/jquery.min.js"></script>
<script src="login/js/main.js"></script>

</body>
</html>
