<?php
	//Start session
	session_start();
	//Unset the variables stored in session
	unset($_SESSION['ID']);
	unset($_SESSION['username']);
	unset($_SESSION['role']);
	/* Main database connection string */
    require "classes/db/db_connect.php"; 
	?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,width=device-width,height=device-height,target-densitydpi=device-dpi,user-scalable=yes" />
    <title>InvisoVideo | Sign In</title>
    
    <!-- fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/app/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/app/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/app/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/app/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/app/ico/favico.png">
    <link rel="shortcut icon" href="assets/app/ico/favico.ico">

    <!-- theme fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300italic,300,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- theme bootstrap stylesheets -->
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- theme dependencies stylesheets -->
    <link href="assets/app/css/dependencies.css" rel="stylesheet" />

    <!-- theme app main.css (this import of all custom css, you can use requirejs for optimizeCss or grunt to optimize them all) -->
    <link href="assets/app/css/syrena-admin.css" rel="stylesheet" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
    body{
        overflow: hidden; /* just for Sign page */
        background-color: #000;
    }
    </style>
  </head>

  <body>
    <!-- content wrapper to define fullpage or container -->
    <!-- (recomended: dont change the id value) -->
    <section id="wrapper" class="container">
        <section id="signin" class="sign-wrapper signin transition-layout">
            <div class="row">
                <div class="col-md-offset-4 col-sm-offset-0 col-xs-offset-0 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-brand">
                        <div class="sign-brand-logo">
                            <img src="assets/app/img/brand-md.png" alt="Brand" height="45" width="100"/>
                        </div>
                        <h1 class="sign-brand-name">InvisoVideo</h1>
                    </div><!-- /sign-brand -->
                    <div class="sign-container">

						<?php
 						    require_once "classes/user/user.php";
                            $user = new User();
                            
                            if(isset($_POST['login-submit'])) {
                                  $loggedIn = $user->login($_POST['login-username'],$_POST['login-password']);
                              if($loggedIn->validated) {
                                if ($loggedIn->role == 1) {
                                  header("Location:live.php");
                                }
                                else {
                                  header("Location:live.php");
                                }
                                
                              }
                              else
                              {
							  echo "<div class=\"alert alert-danger alert-icon\">
                                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                                            <div class=\"icon\"><i class=\"icon ion-ios7-close-empty\"></i></div>
                                            <strong>Oops!</strong> Invalid username or password.
                                        </div>";
								
                              }
                            } elseif ( isset($_GET['logout']) && $_GET['logout'] == 1) {
                              $user->logout('index.php')  ;
                              echo "<div class=\"green\">You've sussessfully Logged out.</div>";
                            }
                            ?>
							
												<form action="" accept-charset="UTF-8" method="post" role="form">
                        
                            <div class="form-group">
                                <input type="text" class="form-control" name="login-username" id="login-username" placeholder="Username" >
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <input type="password" class="form-control" name="login-password" id="login-password" placeholder="Password" >
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <input  type="submit" id="login-button" class="btn btn-lg btn-primary btn-block" name="login-submit" value="Log In" >
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <input class="iCheck" id="rememberme" name="rememberme" type="checkbox" checked>
                                <label class="icheck-label" for="rememberme">Stay signed in</label>
                            </div><!-- /form-group -->
                        </form>
                    </div><!-- /sign-container -->
                </div><!-- /col -->
            </div><!-- /row -->
			
			


            <div class="sign-footer">
                <a href="#signup" data-toggle="transition-layout" class="btn btn-link text-inverse">Register for InvisoVideo</a>
                <a href="#recover" data-toggle="transition-layout" class="btn btn-link text-inverse">Forgot password</a>
            </div><!-- /sign-footer -->
        </section><!-- /signin -->

        <section id="signup" class="sign-wrapper signup transition-layout">
            <div class="row">
                <div class="col-md-offset-4 col-sm-offset-0 col-xs-offset-0 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-brand">
                        <div class="sign-brand-logo">
                            <img src="assets/app/img/brand-md.png" alt="Brand"/>
                        </div>
                        <h1 class="sign-brand-name">Register for InvisoVideo</h1>
                    </div><!-- /sign-brand -->
                    <div class="sign-container">
                        <form role="form" action="index.html">
                            <div class="form-group">
                                <input type="text" class="form-control" name="signup-username" placeholder="Username" >
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <input type="email" class="form-control" name="signup-email" placeholder="Email" >
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <input type="password" class="form-control" name="signup-password" placeholder="Password" >
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <input type="password" class="form-control" name="signup-cpassword" placeholder="Repeat password" >
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Register" >
                            </div><!-- /form-group -->
                        </form>
                    </div><!-- /sign-container -->
                </div><!-- /col -->
            </div><!-- /row -->

            <div class="sign-footer">
                <a href="#signin" data-toggle="transition-layout" class="btn btn-link text-inverse">Already have an account?</a>
            </div><!-- /sign-footer -->
        </section><!-- /signup -->

        <section id="recover" class="sign-wrapper recover transition-layout">
            <div class="row">
                <div class="col-md-offset-4 col-sm-offset-0 col-xs-offset-0 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-brand">
                        <div class="sign-brand-logo">
                            <img src="assets/app/img/brand-md.png" alt="Brand"/>
                        </div>
                        <h1 class="sign-brand-name">InvisoVideo</h1>
                    </div><!-- /sign-brand -->
                    <div class="sign-container">
                        <form role="form" action="index.html">
                            <div class="form-group">
                                <input type="email" class="form-control input-lg" name="recover-email" placeholder="Email" >
                                <small class="help-block text-inverse">Enter your email address and we will send you a link to reset your password</small>
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Send reset link" >
                            </div><!-- /form-group -->
                        </form>
                    </div><!-- /sign-container -->
                </div><!-- /col -->
            </div><!-- /row -->

            <div class="sign-footer">
                <a href="#signin" data-toggle="transition-layout" class="btn btn-link text-inverse">Sign In</a>
                <a href="#signup" data-toggle="transition-layout" class="btn btn-link text-inverse">Sign Up for InvisoVideo</a>
            </div><!-- /sign-footer -->
        </section><!-- /recover -->
    </section><!-- /wrapper -->

    


    <!-- jQuery, theme required for theme -->
    <script src="assets/jquery/jquery.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- theme dependencies -->
    <!-- 
        Contents List
        1. Raphaël
        2. Isotope
        3. verge
        4. Moment
        5. Prettify
    -->
    <script src="assets/app/js/dependencies.js"></script>
        
        <!-- other dependencies -->
        <script src="assets/jquery-icheck/jquery.icheck.min.js"></script>
    
    <!-- theme app main.js -->
    <script src="assets/app/js/main.js"></script>

    <script type="text/javascript">
    $(function() {
        'use strict';

        $('.iCheck').iCheck({
            checkboxClass: 'icheckbox_flat',
            radioClass: 'iradio_flat',
        });
    })
    </script>
  </body>
</html>