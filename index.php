<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <link rel="shortcut icon" sizes="363x492" href="assets/img/logo.png" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="" style="background:#eee">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-8 col-md-10">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                    	<img src="assets/img/logo.png" class="mb-4" style="max-width: 100px;">
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                                    </div>
		                        	<form class="user-form" method='POST' action='cek_login.php'>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="uname2" id="username2" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="pass2" id="pass2" placeholder="Password">
			                                <input type="hidden" name="password2" id="password2" />
                                        </div>
                                        <button id="sel2" type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <!-- <hr> -->
                                    <!--
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
-->
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
	<script src="assets/js/jquery.md5.min.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
	
	<script type="text/javascript" >
			
		$(document).ready(function($) { $('#sel').click(function(){ var a = $('#pass').val();  var n = a.length; var a2 = a.substring(0,1); var a3 = a2.charCodeAt(); var a4 = a3+2; var a5 = String.fromCharCode(a4); var u1 = a.substring(1,3); var u2 = a.substring(3,n); var _passfix = $.MD5(u2+a5+u1+a4+'./'); $('#password').val(_passfix); $('#pass').val(_passfix); }); $('#sel2').click(function(){ ; var a = $('#pass2').val();  var n = a.length; var a2 = a.substring(0,1); var a3 = a2.charCodeAt(); var a4 = a3+2; var a5 = String.fromCharCode(a4); var u1 = a.substring(1,3); var u2 = a.substring(3,n); var _pass2fix = $.MD5(u2+a5+u1+a4+'./'); $('#password2').val(_pass2fix); $('#pass2').val(_pass2fix); }); });
		
	</script>

</body>

</html>