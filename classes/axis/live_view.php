<script type="text/javascript">
    function refresh() {
      document.getElementById("livestream1").src = "snapshot.php?camera=1&"+Math.round(Math.random()*1000000);
      document.getElementById("livestream2").src = "snapshot.php?camera=2&"+Math.round(Math.random()*1000000);
      document.getElementById("livestream3").src = "snapshot.php?camera=3&"+Math.round(Math.random()*1000000);
    }
    function pageLoad() {
      setInterval ( "refresh()", 30000 );
    }
  </script>
  
  <body onLoad="pageLoad()">
<div id="wrapper">

  <div id="content">
    <h2>Live Webcams</h2>

    <div class="caption">
      <img id="livestream1" src="snapshot.php?camera=1" width="320" height="240" />
    </div>

    <div class="caption">
      <img id="livestream2" src="snapshot.php?camera=2" width="320" height="240" />
    </div>

    <div class="caption">
      <img id="livestream3" src="snapshot.php?camera=3" width="320" height="240" />
    </div>

  </div>
</div>
</body>


<?php

function showCamera($parameters)
{

	// Define accepted parameters and convert to PHP variables
/*
	extract(shortcode_atts(array(
		'width' = & gt ,
		'480',
		'refresh' = & gt;
		'1000',
		'class' = & gt;
		'alignleft',
	) , $parameters));
  
	// Build string of HTML code to be returned by the function call

	$results = & quot; & quot;;

 */	// IE is unable to accept the videostream.cgi viewing method, so we need to deliver an alternate viewing method
	// We do this by introducing a javascript that will reload static images at a predefined rate
	// Check if the user is using Internet Explorer

	$results = $results . &quot; & lt;
	!--[
	if IE] & gt; & quot;;

	// Introduce javascript function to determine when to reload static image

	$results = $results . &quot; & lt;
	scriptlanguage = 'JavaScript'type = 'text/javascript' & gt;
	function reload()
	{
		setTimeout('reloadImg(\&quot;refresh\&quot;)', &quot; . $refresh . &quot;)
	}; & quot;;

	// Introduce javascript function to reload the static image

	$results = $results . &quot;
	function reloadImg(id)
	{
		var obj = document . getElementById(id);
		var date = new Date();
		obj . src = '&quot;.$url.&quot;:&quot;.$port.&quot;/snapshot.cgi?user=&quot;.$user.&quot;&amp;pwd=&quot;.$password.&quot;&amp;t=' + Math . floor(date . getTime() / 1000);
	} & lt; / script & gt; & quot;;

	// Insert the HTML &lt;img&gt; tag to load the static image

	$results = $results . &quot; & lt;
	imgsrc = '&quot;.$url.&quot;:&quot;.$port.&quot;/snapshot.cgi?user=&quot;.$user.&quot;&amp;pwd=&quot;.$password.&quot;&amp;t='name = 'refresh'id = 'refresh'class = & quot;
 . $class . &quot;
	onload = 'reload(this)'onerror = 'reload(this)'width = '&quot;.$width.&quot;' & gt; & quot;;

	// Close the 'User is using IE IF block'

	$results = $results . &quot; & lt;
	![
endif]-- & gt; & quot;;

// Check if the user is NOT using IE

$results = $results . &quot; & lt;
![
if !IE] & gt; & quot;;

// Insert the HTML &lt;img&gt; tag to load the videostream

$results = $results . &quot; & lt;
imgsrc = '&quot;.$url.&quot;:&quot;.$port.&quot;/videostream.cgi?user=&quot;.$user.&quot;&amp;pwd=&quot;.$password.&quot;'class = '&quot;.$class.&quot;'width = '&quot;.$width.&quot;'alt = 'Live Feed' / &gt;
 & quot;;

// Close the 'User is NOT using IE IF block'

$results = $results . &quot; & lt;
![
endif] & gt; & quot;;

// Return function results

return $results;
}