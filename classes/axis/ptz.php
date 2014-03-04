<?php

$cameras = array(
    'Camera 1' => '192.168.1.121',
    'Camera 2' => '192.168.1.122',
    'Camera 3' => '192.168.1.123'
);

$actions = array(
    'Turn On' => 'power=on',
    'Turn Off' => 'power=off',
    'Pan Up' => 'direction=panUp',
    'Pan Left' => 'direction=panLeft',
    'Pan Right' => 'direction=panRight',
    'Pan Down' => 'direction=panDown'
);

if (in_array($_POST['action'], array_keys($actions)) && in_array($_POST['camera'], $cameras))
{
    $urlRequest = "http://{$_POST['camera']}/cameraCGI?{$actions[$_POST['action']]}";
    file_get_contents($urlRequest);
    $cameraName = array_search($_POST['camera'], $cameras);
    $response = "Request sent to {$cameraName} at IP {$_POST['camera']} to {$_POST['action']}\n";
}

//Create camera options
$cameraOptions = '';
foreach($cameras as $name => $ip)
{
    $cameraOptions .= "<option value=\"{$ip}\">{$name}</option>\n";
}

?>
<html> 
<head></head> 
<body> 
<pre>
<?php echo $response; ?>
</pre>
<form method="POST">

<div style="text-align:center;">
Camera:
<select name="camera" id="camera">
  <?php echo $cameraOptions; ?>
</select>
<br /><br />
<input type="submit" name="action" value="Turn On" />
<input type="submit" name="action" value="Turn Off" />
<br /><br />
<input type="submit" name="action" value="Pan Up" />
<br />
<input type="submit" name="action" value="Pan Left" />
<input type="submit" name="action" value="Pan Right" />
<br />
<input type="submit" name="action" value="Pan Down" />
</div>

</form>
</body>
</html>