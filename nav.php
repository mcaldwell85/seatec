<?php session_start(); ?>
<?php if( isset($_SESSION['ID']) ) { 
	
	
	}
	else {
	 header("Location: login.php?logout=1");
        exit;
	}
	
	include "classes/db/db_connect.php";
	?>
	
	<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,width=device-width,height=device-height,target-densitydpi=device-dpi,user-scalable=yes" />
    <title>InvisoVideo | Home</title>
    
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
  </head>

  <body>
	
	<?php

// Select all entries from the menu table
//$result=mysql_query("SELECT id, label, link, parent FROM menu ORDER BY parent, sort, label");
$result=mysql_query("SELECT s.id as site, s.user_id, s.description, c.id, c.description, c.url FROM sites s
	INNER JOIN cameras c ON c.site_id = s.id
	WHERE s.user_id = 2
	ORDER BY site;");

// Create a multidimensional array to conatin a list of items and parents
$menu = array(
    'cameras' => array(),
    'sites' => array()
);
// Builds the array lists with data from the menu table
while ($cameras = mysql_fetch_assoc($result))
{
    // Creates entry into items array with current menu item id ie. $menu['items'][1]
    $menu['cameras'][$cameras['c.id']] = $cameras;
    // Creates entry into parents array. Parents array contains a list of all items with children
    $menu['sites'][$cameras['site']][] = $cameras['c.id'];
}

// Menu builder function, parentId 0 is the root
function buildMenu($site, $menu)
{
   $html = "";
   if (isset($menu['sites'][$site]))
   {
      $html .= "
      <ul>\n";
       foreach ($menu['sites'][$site] as $camera_id)
       {
          if(!isset($menu['sites'][$camera_id]))
          {
             $html .= "<li>\n  <a href='".$menu['cameras'][$camera_id]['c.url']."'>".$menu['cameras'][$camera_id]['c.description']."</a>\n</li> \n";
          }
          if(isset($menu['sites'][$camera_id]))
          {
             $html .= "
             <li>\n  <a href='".$menu['cameras'][$camera_id]['c.url']."'>".$menu['cameras'][$camera_id]['c.description']."</a> \n";
             $html .= buildMenu($camera_id, $menu);
             $html .= "</li> \n";
          }
       }
       $html .= "</ul> \n";
   }
   return $html;
}
echo buildMenu(0, $menu);



?>


</body>
</html>


