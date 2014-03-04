<?php  #include  ?>
<?php session_start(); ?>
<!doctype html>
<html>
  <head>
    <title><?php echo "InvisoVideo | ".$title ?></title>
	
	//Functions
	
	// If logged in, show logout button
	<?php if( isset($_SESSION['ID']) ) { ?>
                        <li><a href="index.php?logout=1" class="logout">Logout</a></li>
                      <?php } ?>
	
	//If logged in, welcome username
	                <?php if( isset($_SESSION['ID']) ) { ?>
                    <div class="welcome"> <?php echo "Welcome ".$_SESSION['username'].", ".date(" Y-m-d  h:i a");?></div>
                <?php } ?>
				
	// If Admin User, show admin options
	       <?php if ($_SESSION['role'] == 1) { ?>  
            <li
            <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            Admin Menu
            <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="user_listing.php">Manage Users</a></li>
                <li><a href="data.php">View Live Data</a></li>
            </ul>
        <?php } ?>
	
	
	//Show Active Page from Page Title in navigation
	<li <?php echo ($sub_section == "dashboard")?'class="active"':'' ?>>
            <a href="#">Dashboard</a> 
          </li>
          <li <?php echo ($sub_section == "sales_report")?'class="active"':'' ?>>
            <a href="sales_reports.php">Sales Report</a> 
          </li>
          <li <?php echo ($sub_section == "plu")?'class="active"':'' ?> >
            <a href="plu.php">PLU Sales</a> 
          </li>
          <li <?php echo ($sub_section == "timekeeping_report")?'class="active"':'' ?>>
            <a href="timekeeping_report.php">Timekeeping</a> 
          </li>
          <li <?php echo ($sub_section == "sales_journal")?'class="active"':'' ?>>
            <a href="sales_journal.php">Sales Journal</a> 
          </li>
          <li <?php echo ($sub_section == "exceptions")?'class="active"':'' ?> >
            <a href="exceptions.php">Exceptions</a> 
          </li>
          <li <?php echo ($sub_section == "trans_log")?'class="active"':'' ?> >
            <a href="translog.php">Trans Log</a> 
          </li>
          <li <?php echo ($sub_section == "labor")?'class="active"':'' ?> >
            <a href="labor.php">Labor</a> 
          </li>
          <li <?php echo ($sub_section == "hourly")?'class="active"':'' ?> >
				</li>	  
	
   

  <script>
  function location_change(location_id) {
      $.ajax({
            type: "POST",
            cache:false,
            dataType: "json",
            url: "get_location_pos_users.php",
            data: { loc: location_id }
        }).done(function( data ) {
          console.log(data);
              var pos_options = '', user_options = '';
              var pos_data = data.pos;
              var users_data = data.users;
            //Populate POs Numbers for the selected location  
            for (var i = 0; i < pos_data.length; i++) {
              pos_options += '<option value="' + pos_data[i] + '">' + pos_data[i] + '</option>';
            }

            //Populate users for the selected location  
            for (var i = 0; i < users_data.length; i++) {
              user_options += '<option value="' + users_data[i] + '">' + users_data[i] + '</option>';
            }

            $("select#pos").html(pos_options);
            $("select#username").html(user_options);
        }).fail(function(msg) {
              showalert("Failed to : "+ msg,"alert-error");
        });     
    }

    var tableToExcel = (function() {
      var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
      return function(table, name) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        window.location.href = uri + base64(format(template, ctx))
      }
    })()


  $(function() {          
    $( ".datepicker" ).datepicker();
  	 $.datepicker.setDefaults($.datepicker.regional['nl']); 
  	 $.datepicker.setDefaults({ dateFormat: 'yy-mm-dd' });
     $(".datepicker").datepicker({ });
    var myDate = new Date();
    var month = myDate.getMonth() + 1;
    var datePicker = myDate.getFullYear() + '-' + month + '-' + myDate.getFullDate();
    $(".datepicker").val(datePicker);    
  });

  
/*  $(function() {
    $( ".datepicker" ).datepicker();
    $.datepicker.setDefaults($.datepicker.regional['nl']); 
	$.datepicker.setDefaults({ dateFormat: 'yy-mm-dd' });
    });
*/  
  
  </script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
    
    <script>
function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'TabPOS.net Print');
        mywindow.document.write('<html><head><title>TabPOS.net Print</title>');
        mywindow.document.write('<link rel="stylesheet" href="https://app.divshot.com/themes/cerulean/bootstrap.css">');
     
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

    /**
      Bootstrap Alerts -
      Function Name - showalert()
      Inputs - message,alerttype
      Example - showalert("Invalid Login","alert-error")
      Types of alerts -- "alert-error","alert-success","alert-info"
      Required - You only need to add a alert_placeholder div in your html page wherever you want to display these alerts "<div id="alert_placeholder"></div>"
      Written On - 14-Jun-2013
    **/
    function showalert(message,alerttype) {
      $('#alert_placeholder').append('<div id="alertdiv" class="alert ' +  alerttype + '"><a class="close" data-dismiss="alert"> X </a><span>'+message+'</span></div>')

      // this will automatically close the alert and remove this if the users doesnt close it in 5 secs
      setTimeout(function() { 
        $("#alertdiv").remove();
      }, 5000);
    }

    function sendTo(subj){
      showalert("Sending E-mail... ","alert-info");
      $.ajax({
        type: "POST",
        url: "send_mail.php",
        data: { subject: subj, content: $("#reportBody").html() }
      }).done(function( msg ) {
          showalert("Success: "+ msg,"alert-success");
      }).fail(function(msg) {
          showalert("Failed to Send E-mail: "+ msg,"alert-error");
      });
    }
</script>
    
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      //google.setOnLoadCallback(drawChart);
      function drawChart(chart_title, hAxis_axis_title,chartdata) {
        
        var chart_DATA = new Array();

        for( var i=0; i < chartdata.length; i++ )
        {
           chart_DATA.push(chartdata[i]);   
        }

//console.log(chart_DATA);
        var data = google.visualization.arrayToDataTable(chart_DATA);

        var options = {
          title: chart_title,
          hAxis: {title: hAxis_axis_title, titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <style>
<!--
.tab {  text-indent:40px }
-->

body {
    padding-top: 20px;
    
}


</style>
</head>
<body> 


