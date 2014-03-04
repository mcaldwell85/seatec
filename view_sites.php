<?php session_start(); ?>
<?php include "classes/db/db_connect.php"; ?>	


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
    <!-- content wrapper to define fullpage or container -->
    <!-- (recomended: dont change the id value) -->
    <section id="wrapper" class="container">
        <!-- define side left theme -->
        <aside class="side-left">
            <!-- side header -->
            <div class="side-header">
                <!-- place your brand (recomended: dont change the id value) -->
                <!-- (recomended: dont change the id value) -->
                <h1 id="brand" class="brand">
                    <a href="index.html">
                        <!-- <i class="icon ion-waterdrop"></i> -->
                        <img src="assets/app/img/brand.png" alt="Brand">   <!-- 32px image logo -->
                        InvisoVideo
                    </a>
                </h1><!-- /brand -->

                <!-- form search, remove class hide if you not place your brand -->
                <!-- (recomended: dont change the id value) -->
                <form id="smart-search" class="side-form hide" role="form">
                    <input type="text" class="form-control" data-target=".side-wrapper" placeholder="Search">
                </form><!-- /side wrapper -->
            </div><!-- /side header -->

            <!-- side body -->
            <div class="side-body">
                <!-- this you can place your search result with ajax -->
                <div class="side-wrapper side-wrapper-large">
                    <div class="side-wrapper-status lead">No result, please start typing!</div>
                    <div class="side-wrapper-result">
                        <!-- just sample result -->



                    </div><!-- /side-wrapper-result -->
                </div><!-- /side wrapper -->
				
				
              <!-- separate nav for ease development -->
                <nav class="side-nav">
                    <!-- open nav ul -->
                    <ul>
                       
 
                        <li class="side-nav-item active">
                            <a href="live.php">
                                <i class="nav-item-icon icon ion-ios7-monitor-outline"></i>
                                Live View
                            </a>
                        </li><!-- /coverage -->
						<?php
					//	if(isset($_GET['id']) ) {
						
							$user_id = $_SESSION['ID'];
						//  $user_id = '1';
							$where = "user_id = '$user_id' ";
							$site_sql = "SELECT id, user_id, description, camera_id FROM sites WHERE ".$where." ORDER BY id";
							$site_result = mysql_query($site_sql) or die(mysql_error());
							$site_num = mysql_num_rows($site_result);
							
							$camera_sql = "SELECT id, user_id, url FROM cameras WHERE ".$where." ORDER BY id";
							$camera_result = mysql_query($camera_sql) or die(mysql_error());
							$camera_num = mysql_num_rows($camera_result);
					//		}
						//	if($num > 0) {
							
							while ($site_row = mysql_fetch_object($site_result)) {	?>
                        <li class="side-nav-item">
                            <a href="#<?php echo $site_row->description ?>">
                                <i class="nav-item-caret"></i>
                                <i class="nav-item-icon icon ion-ios7-monitor-outline"></i>
                                <?php	echo $site_row->description	?>
                            </a>
                            <ul id="<?php	echo $site_row->description	?>" class="side-nav-child">
                                <li class="side-nav-item-heading">
                                    <a href="<?php	echo $site_row->description	?>" class="side-nav-back">
                                        <i class="nav-item-caret"></i>
                                        <?php	echo $site_row->description ?>

                                    </a>
                                </li><!-- /header layouts child -->
                                <li class="side-nav-item">
                                    <a href="#">
                                        <i class="nav-item-icon icon ion-laptop"></i>
                                        Camera <?php	echo $site_row->camera_id ?>
                                    </a>
                                </li><!-- /blank -->
                            </ul><!-- /layouts child -->
                        </li><!-- /layout -->
						
																<?php
										} ?>
						



                        <li class="side-nav-item">
                            <a href="#search">
                                <i class="nav-item-caret"></i>
                                <i class="nav-item-icon icon ion-search"></i>
                                Video Search
                            </a>
                            <!-- /level menu child -->
                            <ul id="search" class="side-nav-child">
                                <li class="side-nav-item-heading">
                                    <a href="#level2" class="side-nav-back"> 
                                        <i class="nav-item-caret"></i>
                                        Video Search
                                    </a>
                                </li><!-- /header level menu child -->
                                <li class="side-nav-item">
                                   <a href="#level2" class="side-nav-back"> 
                                        <i class="nav-item-icon icon ion-ios7-monitor-outline"></i>
                                        Video Search
                                    </a>
                                </li><!-- /menu -->
                            </ul><!-- /level menu child -->
                        </li><!-- /level menu -->							
					
							

                    </ul><!-- /nav ul-->
                </nav>

            </div><!-- /side body -->
        </aside><!-- /side left -->

        <!-- define content theme, use data-swipe="true" to enable gesture event -->
        <!-- (recomended: dont change the id value) -->
        <section id="content" class="content">
            <!-- define your content header here -->
            <header class="content-header">
                <!-- header actions -->
                <div class="header-actions pull-right">
                    <!-- (recomended: dont change the id value) -->
                    <div class="btn-group">
                        <a id="notif-alerts" class="btn btn-icon hide-sm dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="icon ion-alert-circled"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-extend pull-right" role="menu">
                            <li class="dropdown-header">Notifications</li><!-- /dropdown-header -->
                            <li class="notif-minimal">
                                <a class="notif-item" href="#">
                                    
                                    <p class="notif-text"><span class="text-danger">No Alerts</span></p>
                                </a><!-- /notif-item -->
                            </li><!-- /dropdown-alert -->
                            <li class="dropdown-footer">
                                <a class="view-all" tabindex="-1" href="#">
                                    <i class="icon ion-ios7-arrow-thin-right pull-right"></i> See all notifications
                                </a>
                            </li><!-- /dropdown-footer -->
                        </ul><!-- /dropdown-extend -->
                    </div><!-- /btn-group notifications -->



                    <!-- (recomended: dont change the id value) -->
                    <div class="btn-group">
                        <a id="users-setting" class="btn btn-icon data-toggle" data-toggle="dropdown" role="button">
                            <i class="icon ion-gear-b"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-extend pull-right" role="menu">
                            <li class="dropdown-profile">
                                <div class="dp-cover">
                                    <img class="img-bg" src="assets/app/img/cover-blur.jpg" alt="">
                                    <a class="img-avatar" href="page_profile.html">
                                        <img class="img-circle" src="assets/app/img/brand-md.png" alt="">
                                    </a>
                                    <div class="dp-details"><?php if( isset($_SESSION['ID']) ) {
                     echo $_SESSION['username'] ;
                } ?></div>
                                </div>
                            </li>
                            <li class="dropdown-footer">
                                <div class="clearfix">
								<?php if( isset($_SESSION['ID']) ) { ?>
                        <a href="login.php?logout=1" class="btn btn-default pull-right">Sign out</a>
                      <?php } ?>
                                    
                                    <a href="user_listing.php" class="btn btn-default pull-left">Manage Users, Cameras, Sites</a>
                                </div>
                            </li><!-- /dropdown-footer -->
                        </ul><!-- /dropdown-extend -->
                    </div><!-- /btn-group setting -->

                    <!-- (recomended: dont change the id value) -->
                    <a id="toggle-aside" class="btn btn-icon" role="button"><i class="icon ion-navicon-round"></i></a>
                </div><!-- /header actions -->

                <!-- header actions -->
                <div class="header-actions pull-left">
                    <!-- (recomended: dont change the id value) -->
                    <button id="toggle-content" class="btn btn-icon" type="button"><i class="icon ion-navicon-round"></i></button>
                    <!-- (recomended: dont change the id value) -->
                    <button id="toggle-search" class="btn btn-icon" type="button"><i class="icon ion-search"></i></button>

						                

                </div><!-- /header actions -->

                <!-- your Awesome App title -->
                <h1 class="content-title"></h1>
            </header><!-- /side left -->
            

            <!-- define content row -->
            <div class="content-spliter">
                <!-- define your awesome apps here -->
                <!-- (recomended: dont change the id value) -->
                <section id="content-main" class="content-main">
                    
                    <!-- your app content -->
                    <div class="content-app fixed-header">
                        <!-- app header 
                        <div class="app-header">
                            <div class="pull-right">
                                <button class="btn btn-flat btn-default" id="dashboard-range">
                                    <span class="icon ion-ios7-calendar-outline"></span>
                                    <span class="text-date">Oct 30, 2013 - Nov 29, 2013</span> 
                                    <b class="caret"></b>
                                </button>
                            </div>
                            <h3 class="app-title pull-left hidden-xs">Weekly Resume <small>Oct 30 - Nov 29, 2013</small></h3>
                        </div> /app header -->

                        <!-- app body -->
                        <div class="app-body">
                            
                            <!-- main page app content here -->

<?php
if(isset($_POST['delete']) ) {
	$deleted = $_POST['checkbox'];
	$user_id  = $_POST['user_id'];
	$n = 0;
	foreach ($deleted as $index => $value) {
		// $del_sql = "DELETE FROM terminals WHERE terminal_id = '$value'";
		// $result = mysql_query($del_sql) or die(mysql_error());

		$del_sql = "DELETE FROM sites WHERE user_id = '$value'";
		$result = mysql_query($del_sql) or die(mysql_error());

		$n++;
	}
echo "<p>Deleted ". $n ."item(s)</p>";
header("Location:user_listing.php");
}

$user_id = $_GET['id'];

$where = "user_id = '$user_id' ";


$sql = "SELECT id, description FROM sites WHERE ".$where." ORDER BY id";

$result = mysql_query($sql) or die(mysql_error());

$num = mysql_num_rows($result);
if($num > 0) {
echo "<h2>".$num ." row(s) returned.</h2>";
echo "<a href='add_site.php?id=$user_id'>Add Site </a> | ";
echo "<a href='user_listing.php'>Back to User Listing </a>";
?>
<form action="" name="listingForm" id="listingForm" method="post">
	<input type="hidden" name="user_id" value="<?php echo $_GET['user_id'] ?>">
	<div class="table-responsive">
<table class="table table-hover">
	<thead>
	<tr class="headerRow">
		<th><input type="checkbox" onclick="toggleChecked(this.checked)"></th>
		<th>Site</th>
	</tr>
</thead>
<tbody>
<?php
	while ($row = mysql_fetch_object($result)) {		
	?>
	<tr class="gridRow">
		<td><input name="checkbox[]" type="checkbox" class="checkbox" value="<?php echo $row->id; ?>"></td>
		<td><?php echo $row->description ?></td>
	</tr>
	<?php	
	}
	?>
	<tr>
<td colspan="20" bgcolor="#FFFFFF"><input name="delete" type="submit" id="delete" value="Delete" style="background:red;"></td>
</tr>
</tbody>
</table>
</div>
</form>
	<?php
}
else {
	echo "No records found.";
}
?>


                            
                        </div><!-- /app body -->
                    </div><!-- /content app -->

                </section><!-- /content main -->
                

                
                <!-- define your extra apps here -->
                <!-- (recomended: dont change the id value) -->
                <section id="content-aside" class="content-aside">
                    <!-- your module content -->
                    <div class="content-module fixed-header">
                        <!-- module header -->
                        <div class="module-header">
                            <h3 class="module-title">
                                <i class="icon ion-ios7-chatboxes-outline"></i> Controls
                            </h3>
                        </div><!-- /module header -->

                        <!-- module body -->
                        <div class="module-body">
						
						<div class="chats-module">

							<div class="cm-contact">
								<div class="cm-contact-separate"></div>
									<a class="cm-contact-item" href="#">
									<div class="cmci-avatar">
										<img alt="" src="assets/app/img/brand-md.png"></img>
									</div>
									<h4 class="cmci-name">
										PTZ Controls
									</h4>
									</a>
									<a class="cm-contact-item" href="#">
									<div class="cmci-avatar">
										<img alt="" src="assets/app/img/brand-md.png"></img>
									</div>
									<h4 class="cmci-name">
										Camera View/Layout
									</h4>
									</a>
						
                        </div><!-- /module content -->
                    </div><!-- /content module -->
                </section><!-- /content asside -->
            </div><!-- /content spliter -->

        </section><!-- /content -->
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
        <script src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="assets/morris/morris.min.js"></script>
        <script src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
        <script src="assets/select2/select2.min.js"></script>
        <script src="assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    
    <!-- theme app main.js -->
    <script src="assets/app/js/main.js"></script>
    <script type="text/javascript">
    $(function () {
        
        // date range picker
        $('#dashboard-range').daterangepicker(
            {
              ranges: {
                 'Today': [moment(), moment()],
                 'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                 'Last 7 Days': [moment().subtract('days', 6), moment()],
                 'Last 30 Days': [moment().subtract('days', 29), moment()],
                 'This Month': [moment().startOf('month'), moment().endOf('month')],
                 'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
              },
              startDate: moment().subtract('days', 6),
              endDate: moment()
            },
            function(start, end) {
                $('#dashboard-range .text-date').text(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
            }
        );


        
        // charts
        // chart revenue
        var data1 = [
            {dates: '2013-10-30', sales: 236},
            {dates: '2013-10-31', sales: 137},
            {dates: '2013-11-01', sales: 275},
            {dates: '2013-11-02', sales: 380},
            {dates: '2013-11-03', sales: 655},
            {dates: '2013-11-04', sales: 571}
        ],
        revenueChart = Morris.Line({
            element: 'revenue-chart',
            data: data1,
            lineColors: ['#3498db'],
            gridTextColor: '#34495e',
            pointFillColors: ['#3498db'],
            xkey: 'dates',
            ykeys: ['sales'],
            labels: ['Sales'],
            barRatio: 0.4,
            hideHover: 'auto'
        }),
        salesChart = Morris.Donut({
            element: 'sales-chart',
            data: [
                {label: 'Download Sales', value: 25 },
                {label: 'In-Store Sales', value: 40 },
                {label: 'Mail-Order Sales', value: 25 },
                {label: 'Respond Sales', value: 10 }
            ],
            colors: ['#f39c12', '#3498db', '#2ecc71', '#e74c3c'],
            gridTextColor: '#3498db',
            formatter: function (y) { return y + "%" }
        }),
        data_items = [
            {themes: 'Stilearn', purchase: 136},
            {themes: 'StilMetro', purchase: 137},
            {themes: 'Syrena', purchase: 675},
            {themes: 'Biosia', purchase: 380},
            {themes: 'GlitFlat', purchase: 655},
            {themes: 'Zahra', purchase: 1571}
        ],
        itemsChart = Morris.Bar({
            element: 'items-chart',
            data: data_items,
            barColors: ['#3498db'],
            gridTextColor: '#34495e',
            xkey: 'themes',
            ykeys: ['purchase'],
            labels: ['Purchase'],
            barRatio: 0.4,
            xLabelAngle: 30,
            hideHover: 'auto'
        });

        // update data on content or window resize
        var update = function(){
            revenueChart.redraw();
            salesChart.redraw();
            itemsChart.redraw();
        }

        // handle chart responsive on toggle .content
        $(window).on('resize', function(){
            update();
        })
        $('#toggle-aside').on('click', function(){
            // update chart after transition finished
            $("#content").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
                update();
                $(this).unbind();
            });
        })
        $('#toggle-content').on('click', function(){
            update();
        })
        // end chart



        // todo list
        $('.icheck').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green',
            increaseArea: '20%' // optional
        }).on('ifChanged', function(){
            var $this = $(this),
                todo = $(this).parent().parent().parent();

            todo.toggleClass('todo-marked');
            todo.find('.label').toggleClass('label-success');
        });



        // Quick Mail
        $('#quick-mail-reseiver').tagsInput({
            height: '70px',
            width:'auto',           // support percent (90%)
            defaultText: '+ reseiver'
        });
        // manual style for .tagsinput
        $('div.tagsinput input').on('focus', function(){
            var tagsinput = $(this).parent().parent();
            tagsinput.addClass('focus');
        }).on('focusout', function(){
            var tagsinput = $(this).parent().parent();
            tagsinput.removeClass('focus');
        });
        $('#quick-mail-content').wysihtml5({
            "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": true, //Italics, bold, etc. Default true
            "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": false, //Button which allows you to edit the generated HTML. Default false
            "link": true, //Button to insert a link. Default true
            "image": true, //Button to insert an image. Default true,
            "color": false, //Button to change color of font  
            "size": 'sm' // use button small ion and primary
        });
    })
    </script>
  </body>
</html>