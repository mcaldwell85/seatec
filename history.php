
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/images/favicon.png">

    <title>SeaTec Security | Home</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/styles/bootstrap2.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
      <script src="/js/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="assets/styles/carousel.css" rel="stylesheet">
    <style>
    @media (min-width: 1200px) {
    .container{
        max-width: 970px;
    }
}
</style>
    
  </head>

  <body>

<!-- NAVBAR
================================================== -->
  <body>
  <div class="navbar navbar-inverse">
   <div class="container">
    <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
	<a class="navbar-brand" href="#">SeaTec Security</a></div>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
     <ul class="nav navbar-nav">
      <li>
       <a href="index.php">Home</a></li>
      <li>
       <a href="live.php">Live View</a></li>
      <li class="active">
	   <a href="#">Video History</a></li>
      <li>
       <a href="support.php">Support</a></li>
      <li>
	  <a href="settings.php">Settings</a>
      </li>
            <li>
	  <a href="index.php">Logout</a>
      </li>
     </ul>
    </div>
<!--/.navbar-collapse -->   </div>
  </div>
      

		
	<br>
        
        <div class="container">
            <div class="btn-group btn-default">
            <button data-toggle="dropdown" class="btn dropdown-toggle">Select a Date <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
            </div>
            <div class="btn-group btn-default">
            <button data-toggle="dropdown" class="btn dropdown-toggle">Select a Site <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
            </div>
  
            <br>
            <hr>
	
        <div class="well">
                  <div class="row row-offcanvas row-offcanvas-left">
        
        <!-- sidebar -->
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <ul class="nav">
              <li class="active"><a href="#">Cam1</a></li>
              <li><a href="#">Cam2</a></li>
              <li><a href="#">Cam3</a></li>    
              <li><a href="#">Cam4</a></li>
              <li><a href="#">Cam5</a></li>
              <li><a href="#">Cam6</a></li> 
              <li><a href="#">Cam7</a></li>
              <li><a href="#">Cam8</a></li> 
            </ul>
        </div>
        <img src="http://placehold.it/480x320" width="450" />
        <br>
        <hr>
        <div class="row text-center">
            <a href="#"><img src="images/grid4.png" height="96" width="96" alt="4" /></a>
            <a href="#"><img src="images/grid9.png" height="96" width="96" alt="9" /></a>
            <a href="#"><img src="images/grid16.png" height="96" width="96" alt="16" /></a>
	</div>
           
  </div> 
            <hr>
        <div class="row text-center">
            <a href="#"><img src="images/skip_back2.png" height="96" width="96" alt="Back" /></a>
            <a href="#"><img src="images/skip_back.png" height="96" width="96" alt="Back" /></a>
            <a href="#"><img src="images/play.png" height="96" width="96" alt="Play" /></a>
            <a href="#"><img src="images/pause.png" height="96" width="96" alt="Pause" /></a>
            <a href="#"><img src="images/stop.png" height="96" width="96" alt="Stop" /></a>
            <a href="#"><img src="images/skip_forward.png" height="96" width="96" alt="Fwd" /></a>
            <a href="#"><img src="images/skip_forward2.png" height="96" width="96" alt="Fwd" /></a>
	</div>
        
        
        
        </div>
      <!-- FOOTER -->
      <footer>
		    
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p style="text-align:center;">&copy; 2013 SeaTec Security Solutions LLC All Rights Reserved. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>


              </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/holder.js"></script>
    <script>
    $('.datetimepicker').datetimepicker().on('changeDate', function(ev){
    console.log(ev.date.valueOf());
});
</script>
  </body>
</html>
