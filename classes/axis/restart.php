<?php

$host="192.168.1.5" ;
$target="/axis-cgi/admin/restart.cgi" ;
$port=9090;
$timeout=60;
$br="\r\n" ;
$usarname="root";
$password="admin";
$sk=fsockopen($host,$port,$errnum,$errstr,$timeout ) ;
if(!is_resource($sk)){
exit("Connection failed: ".$errnum." ".$errstr) ;
}
else{
$headers = "GET ".$target." HTTP/1.1".$br ;
$headers.="Accept: */*".$br ;
$headers.="Accept-Language: it".$br ;
$headers.="Host: ".$host.$br ;
$headers .= 'Authorization: Basic '
. base64_encode('root:password_root' . $br . $br);
}
?>