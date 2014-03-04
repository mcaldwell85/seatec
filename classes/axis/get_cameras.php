<?php

$cameras = array(
    'Camera 1' => '192.168.1.121',
    'Camera 2' => '192.168.1.122',
    'Camera 3' => '192.168.1.123',
	'Camera 4' => '192.168.1.121',
    'Camera 5' => '192.168.1.122',
    'Camera 6' => '192.168.1.123',
	'Camera 7' => '192.168.1.121',
    'Camera 8' => '192.168.1.122',
    'Camera 9' => '192.168.1.123',
	'Camera 10' => '192.168.1.121',
    'Camera 11' => '192.168.1.122',
    'Camera 12' => '192.168.1.123',
	'Camera 13' => '192.168.1.123',
	'Camera 14' => '192.168.1.121',
    'Camera 15' => '192.168.1.122',
    'Camera 16' => '192.168.1.123'
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