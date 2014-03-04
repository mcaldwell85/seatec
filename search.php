
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/images/favicon.png">

    <title>SeaTec Security | Search</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
<style>
    body {
    padding-top: 60px; /* When using the navbar-top-fixed */
    }
</style>
<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
  </head>

  <body>

<!-- NAVBAR
================================================== -->
  <body>
  
  <div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="#">SeaTec NVR</a>
      <div class="nav-collapse">
        <ul class="nav">
          <li><a href="#"><i class="icon-home"></i> Home</a></li>
          <li><a href="live.php"><i class="icon-eye-open"></i> Live</a></li>
          <li class="active"><a href="#"><i class="icon-search"></i> Search</a></li>
		  <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i> View/Layout <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#"><i class="icon-stop"></i> 1x1</a></li>
              <li><a href="#"><i class="icon-th-large"></i> 2x2</a></li>
			  <li><a href="#"><i class="icon-th"></i> 3x3</a></li>
			  <li><a href="#"><i class="icon-th"></i> 4x4</a></li>
            </ul>
          </li>
          <li><a href="#"><i class="icon-camera"></i> Snapshot</a></li>
		  <li><a href="#"><i class="icon-move"></i> PTZ</a></li>    

                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Setup <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="#"><i class="icon-user"></i> Account</a></li>
                          <li><a href="#"><i class="icon-eye-open"></i> Live View Settings</a></li>
                          <li><a href="#"><i class="icon-search"></i> Search Settings</a></li>
                        </ul>
                      </li>
                    </ul>
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->
 
        
        <div class="container">
            <label>Select a Site:</label>   
            <form action="dummy" method="post"><select name="choice" size="1" onChange="jump(this.form)"><option value="http://seatecsecurity.com/live.php#">Demo Site 1</option><option value="http://seatecsecurity.com/live.php#">Demo Site 2</option><option value="http://seatecsecurity.com/live.php#">Demo Site 3</option><option value="http://seatecsecurity.com/live.php#">Demo Site 4</option><option value="http://seatecsecurity.com/live.php#">Demo Site 5</option><option value="http://seatecsecurity.com/live.php#">Demo Site 6</option></select></form>
            <br>
        <div class="well well-lg">

<SCRIPT LANGUAGE="JavaScript"> 

var BaseURL; 
BaseURL = "<?php echo $CameraUrl['CameraUrl']; ?>"

var DisplayWidth = "420"; 
var DisplayHeight = "320"; 

var File = "http://16060009.axiscam.net:9090/axis-cgi/mjpg/video.cgi?resolution=CIF&compression=25&fps=3&camera=1";
// var File = "http://pub2.camera.trafficland.com/image/live.jpg?system=pub&webid=8513&pubtoken=3361d091b240b078bf23f72b3c60b4cb&0.1239483852405101"; 

// No changes required below this point 

var output = ""; 
if ((navigator.appName == "Microsoft Internet Explorer") && 
(navigator.platform != "MacPPC") && (navigator.platform != "Mac68k")) 
{ 
// If Internet Explorer under Windows then use ActiveX 
output = '<OBJECT ID="Player" width=' 
output += DisplayWidth; 
output += ' height='; 
output += DisplayHeight; 
output += ' CLASSID="CLSID:DE625294-70E6-45ED-B895-CFFA13AEB044" '; 
output += 'CODEBASE="'; 
output += BaseURL; 
output += 'activex/AMC.cab#version=3,20,18,0">'; 
output += '<PARAM NAME="MediaURL" VALUE="'; 
output += BaseURL; 
output += File + '">'; 
output += '<param name="MediaType" value="mjpeg-unicast">'; 
output += '<param name="ShowStatusBar" value="1">'; 
output += '<param name="ShowToolbar" value="1">'; 
output += '<param name="AutoStart" value="1">'; 
output += '<param name="StretchToFit" value="1">'; 
output += '<BR><B>Axis Media Control</B><BR>'; 
output += 'The AXIS Media Control, which enables you '; 
output += 'to view live image streams in Microsoft Internet'; 
output += ' Explorer, could not be registered on your computer.'; 
output += '<BR></OBJECT>'; 
} else { 
// If not IE for Windows use the browser itself to display 
theDate = new Date(); 
output = '<IMG SRC="'; 
output += BaseURL; 
output += File; 
output += '&dummy=' + theDate.getTime().toString(10); 
output += '" HEIGHT="'; 
output += DisplayHeight; 
output += '" WIDTH="'; 
output += DisplayWidth; 
output += '" ALT="Camera Image">'; 
} 
document.write(output); 
document.Player.ToolbarConfiguration = "play,+snapshot,+fullscreen" 
// document.Player.UIMode = "MDConfig"; 
// document.Player.MotionConfigURL = "/axis-cgi/operator/param.cgi?ImageSource=0" 
// document.Player.MotionDataURL = "/axis-cgi/motion/motiondata.cgi"; 
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript"> 

var BaseURL; 
BaseURL = "<?php echo $CameraUrl['CameraUrl']; ?>"

var DisplayWidth = "420"; 
var DisplayHeight = "320";  

var File = "http://16060009.axiscam.net:9090/axis-cgi/mjpg/video.cgi?resolution=CIF&compression=25&fps=3&camera=2";

// No changes required below this point 

var output = ""; 
if ((navigator.appName == "Microsoft Internet Explorer") && 
(navigator.platform != "MacPPC") && (navigator.platform != "Mac68k")) 
{ 
// If Internet Explorer under Windows then use ActiveX 
output = '<OBJECT ID="Player" width=' 
output += DisplayWidth; 
output += ' height='; 
output += DisplayHeight; 
output += ' CLASSID="CLSID:DE625294-70E6-45ED-B895-CFFA13AEB044" '; 
output += 'CODEBASE="'; 
output += BaseURL; 
output += 'activex/AMC.cab#version=3,20,18,0">'; 
output += '<PARAM NAME="MediaURL" VALUE="'; 
output += BaseURL; 
output += File + '">'; 
output += '<param name="MediaType" value="mjpeg-unicast">'; 
output += '<param name="ShowStatusBar" value="1">'; 
output += '<param name="ShowToolbar" value="1">'; 
output += '<param name="AutoStart" value="1">'; 
output += '<param name="StretchToFit" value="1">'; 
output += '<BR><B>Axis Media Control</B><BR>'; 
output += 'The AXIS Media Control, which enables you '; 
output += 'to view live image streams in Microsoft Internet'; 
output += ' Explorer, could not be registered on your computer.'; 
output += '<BR></OBJECT>'; 
} else { 
// If not IE for Windows use the browser itself to display 
theDate = new Date(); 
output = '<IMG SRC="'; 
output += BaseURL; 
output += File; 
output += '&dummy=' + theDate.getTime().toString(10); 
output += '" HEIGHT="'; 
output += DisplayHeight; 
output += '" WIDTH="'; 
output += DisplayWidth; 
output += '" ALT="Camera Image">'; 
} 
document.write(output); 
document.Player.ToolbarConfiguration = "play,+snapshot,+fullscreen" 
// document.Player.UIMode = "MDConfig"; 
// document.Player.MotionConfigURL = "/axis-cgi/operator/param.cgi?ImageSource=0" 
// document.Player.MotionDataURL = "/axis-cgi/motion/motiondata.cgi"; 
</SCRIPT>

<br>

<SCRIPT LANGUAGE="JavaScript"> 

var BaseURL; 
BaseURL = "<?php echo $CameraUrl['CameraUrl']; ?>"

var DisplayWidth = "420"; 
var DisplayHeight = "320"; 

var File = "http://16060009.axiscam.net:9090/axis-cgi/mjpg/video.cgi?resolution=CIF&compression=25&fps=3&camera=3";

// No changes required below this point 

var output = ""; 
if ((navigator.appName == "Microsoft Internet Explorer") && 
(navigator.platform != "MacPPC") && (navigator.platform != "Mac68k")) 
{ 
// If Internet Explorer under Windows then use ActiveX 
output = '<OBJECT ID="Player" width=' 
output += DisplayWidth; 
output += ' height='; 
output += DisplayHeight; 
output += ' CLASSID="CLSID:DE625294-70E6-45ED-B895-CFFA13AEB044" '; 
output += 'CODEBASE="'; 
output += BaseURL; 
output += 'activex/AMC.cab#version=3,20,18,0">'; 
output += '<PARAM NAME="MediaURL" VALUE="'; 
output += BaseURL; 
output += File + '">'; 
output += '<param name="MediaType" value="mjpeg-unicast">'; 
output += '<param name="ShowStatusBar" value="1">'; 
output += '<param name="ShowToolbar" value="1">'; 
output += '<param name="AutoStart" value="1">'; 
output += '<param name="StretchToFit" value="1">'; 
output += '<BR><B>Axis Media Control</B><BR>'; 
output += 'The AXIS Media Control, which enables you '; 
output += 'to view live image streams in Microsoft Internet'; 
output += ' Explorer, could not be registered on your computer.'; 
output += '<BR></OBJECT>'; 
} else { 
// If not IE for Windows use the browser itself to display 
theDate = new Date(); 
output = '<IMG SRC="'; 
output += BaseURL; 
output += File; 
output += '&dummy=' + theDate.getTime().toString(10); 
output += '" HEIGHT="'; 
output += DisplayHeight; 
output += '" WIDTH="'; 
output += DisplayWidth; 
output += '" ALT="Camera Image">'; 
} 
document.write(output); 
document.Player.ToolbarConfiguration = "play,+snapshot,+fullscreen" 
// document.Player.UIMode = "MDConfig"; 
// document.Player.MotionConfigURL = "/axis-cgi/operator/param.cgi?ImageSource=0" 
// document.Player.MotionDataURL = "/axis-cgi/motion/motiondata.cgi"; 
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript"> 

var BaseURL; 
BaseURL = "<?php echo $CameraUrl['CameraUrl']; ?>"

var DisplayWidth = "420"; 
var DisplayHeight = "320"; 

var File = "http://16060009.axiscam.net:9090/axis-cgi/mjpg/video.cgi?resolution=CIF&compression=25&fps=3&camera=4";

// No changes required below this point 

var output = ""; 
if ((navigator.appName == "Microsoft Internet Explorer") && 
(navigator.platform != "MacPPC") && (navigator.platform != "Mac68k")) 
{ 
// If Internet Explorer under Windows then use ActiveX 
output = '<OBJECT ID="Player" width=' 
output += DisplayWidth; 
output += ' height='; 
output += DisplayHeight; 
output += ' CLASSID="CLSID:DE625294-70E6-45ED-B895-CFFA13AEB044" '; 
output += 'CODEBASE="'; 
output += BaseURL; 
output += 'activex/AMC.cab#version=3,20,18,0">'; 
output += '<PARAM NAME="MediaURL" VALUE="'; 
output += BaseURL; 
output += File + '">'; 
output += '<param name="MediaType" value="mjpeg-unicast">'; 
output += '<param name="ShowStatusBar" value="1">'; 
output += '<param name="ShowToolbar" value="1">'; 
output += '<param name="AutoStart" value="1">'; 
output += '<param name="StretchToFit" value="1">'; 
output += '<BR><B>Axis Media Control</B><BR>'; 
output += 'The AXIS Media Control, which enables you '; 
output += 'to view live image streams in Microsoft Internet'; 
output += ' Explorer, could not be registered on your computer.'; 
output += '<BR></OBJECT>'; 
} else { 
// If not IE for Windows use the browser itself to display 
theDate = new Date(); 
output = '<IMG SRC="'; 
output += BaseURL; 
output += File; 
output += '&dummy=' + theDate.getTime().toString(10); 
output += '" HEIGHT="'; 
output += DisplayHeight; 
output += '" WIDTH="'; 
output += DisplayWidth; 
output += '" ALT="Camera Image">'; 
} 
document.write(output); 
document.Player.ToolbarConfiguration = "play,+snapshot,+fullscreen" 
// document.Player.UIMode = "MDConfig"; 
// document.Player.MotionConfigURL = "/axis-cgi/operator/param.cgi?ImageSource=0" 
// document.Player.MotionDataURL = "/axis-cgi/motion/motiondata.cgi"; 
</SCRIPT>
</BLOCKQUOTE>

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
	<!-- jQuery via Google + local fallback, see h5bp.com -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  </body>
</html>
