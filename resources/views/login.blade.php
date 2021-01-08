<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.79.0">
        <title>Login Page</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Nanum+Gothic:wght@400;700;800&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="loginpage">
            <div class="container-fluid">
                <div class="row">
                    <div class="col login-left"></div>
                    <div class="col login-right">
                        <div class="login-head">
                            <ul class="text-end">
                                <li><a href="dashboard.html" class="btn btn-outline-primary">Sign In</a></li>
                                <li><a href="dashboard1.html" class="btn btn-primary">Create account</a></li>
                            </ul>
                        </div>
                        <div class="loginform">
                            <h3><strong>Welcome back!</strong></h3>
                            <p>Sign in to your account.</p>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating  mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember Me
                                </label>
                            </div>
                            <div class="inputfield mb-3">
                                <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2"  value="Sign In">
                                <p><em><small>Having trouble signing in? <a href="">Reset Password</a></small></em></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
