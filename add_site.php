<?php session_start(); ?>
<?php include "classes/db/db_connect.php"; ?>	


<?php
if(isset($_POST['submit']) ) {
	$site = $_POST['site'];
	$user_id = $_POST['id'];
	
	//AND client_id = '$user_id'
	$check_sql = "SELECT * FROM sites WHERE user_id = '$user_id' ";
	$result = mysql_query($check_sql) or die(mysql_error() );	
	$num = mysql_num_rows($result);
	if ($num < 0) {
		echo "Site already registered!";
	}
	else {
		// $t_sql = "INSERT INTO terminals(POSNumber) VALUES('$pos_number') ";
		// $result = mysql_query($t_sql) or die(mysql_error());
		// $POSNumber = mysql_insert_id();

		$ct_sql = "INSERT INTO sites(user_id, description) VALUES('$user_id','$site') ";
		$result = mysql_query($ct_sql) or die(mysql_error());

		echo "<p> Site Added! </p>";
		echo "<a href='user_listing.php'>Back to User Listing </a>";
	}	
}
?>
<form action="" name="addSite" id="addSite" method="post">
<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
<table cellspacing="0" cellpadding="0" width="50%">
	<tr>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Site</td>
		<td><input type="text" name="site" id="site"></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="submit" value="Add Site"></td>
	</tr>
</table>
</form>
