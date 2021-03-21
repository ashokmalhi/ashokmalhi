<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Ashok Malhi">
        <meta name="generator" content="Hugo 0.79.0">
        <title>Login Page</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>
    <body>
        <div class="loginpage">
            <div class="container-fluid">
                <div class="row">
                    <div class="col login-left"><div class="logo logologin"><img src="{{URL::to('images/logo.png')}}" alt=""></div></div>
                    <div class="col login-right">
                        <div class="login-head">
                            <ul class="text-end">
                                
                            </ul>
                        </div>
                        <div class="loginform">
                            <form method="post" action="{{route('reset-password')}}" id="loginForm">
                                @csrf

                                <h3><strong>Reset Password</strong></h3>
                                <!-- <p class="mb-4">Sign in to your account.</p> -->

                                <div class="inputfield mb-4">
                                    <label for="floatingInput">Email address</label>
                                    <input type="hidden" class="form-control" name="email" id="floatingInput" value="{{$password_reset['email']}}">
                                </div>
                                <div class="inputfield  mb-3">
                                	<label for="floatingPassword">Password</label>
                                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                </div>
                                <div class="inputfield  mb-3">
                                	<label for="floatingPassword">Confirm Password</label>
                                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                </div>
                                <div class="inputfield mb-3">
                                    <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2"  value="Submit">
<!--                                    <p><em><small>Having trouble signing in? <a href="">Reset Password</a></small></em></p>-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/master.js"></script>
</body>
</html>
