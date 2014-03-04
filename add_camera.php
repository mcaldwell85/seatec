<?php session_start(); ?>
<?php include "classes/db/db_connect.php"; ?>	

<?php
if(isset($_POST['submit']) ) {
	$url = $_POST['url'];
	$site = $_POST['site'];
	$user_id = $_POST['id'];

	$check_sql = "SELECT * FROM cameras WHERE url = '$url' AND site_id = '$site' ";	

	$result = mysql_query($check_sql) or die(mysql_error() );	
	$num = mysql_num_rows($result);
	if ($num < 0) {
		echo "Camera already registered!";
	}
	else {
		// $t_sql = "INSERT INTO terminals(POSNumber) VALUES('$pos_number') ";
		// $result = mysql_query($t_sql) or die(mysql_error());
		// $POSNumber = mysql_insert_id();

		$ct_sql = "INSERT INTO cameras(user_id,url, site_id) VALUES('$user_id','$url','$site') ";
		$result = mysql_query($ct_sql) or die(mysql_error());

		echo "<p> Camera Added! </p>";
		echo "<a href='user_listing.php'>Back to User Listing </a>";
	}	
}
?>
<form action="" name="addTerminal" id="addTerminal" method="post">
<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
<table cellspacing="0" cellpadding="0" width="50%">
	<tr>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Camera URL</td>
		<td><input type="text" name="url" id="url"></td>
	</tr>
	<tr>
		<td>Site</td>
		<td>
			<select name="site" id="site">
				<?php
				$site_sql = "SELECT * FROM sites WHERE user_id = '".$_GET['id']."' ";
				$result = mysql_query($site_sql) or die(mysql_error() );	
				while($row = mysql_fetch_object($result)) {
				?>
				<option value="<?php echo $row->id ?>"><?php echo $row->description ?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="submit" value="Add Camera"></td>
	</tr>
</table>
</form>
