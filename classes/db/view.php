<?php
// connect to database
include 'db_connect.php';

// if the link Edit will click this is the code will executed
if(isset($_GET['id_edit'])){
$id = $_GET['id_edit'];
// syntax for SQL SELECT statement
$query_edit="SELECT * FROM tbl_personnel WHERE id = '$id'";
$result_edit = mysql_query($query_edit);
//fetching all data from database tables to put in respective variables.
while($row_edit = mysql_fetch_array($result_edit)){

$fname = $row_edit[1];
$mname = $row_edit[2];
$lname = $row_edit[3];
$gender = $row_edit[4];
}

// if the button update will click this is the code will executed
if(isset($_POST['update'])){
if(!empty($_POST['firstname']) && !empty($_POST['middlename']) && !empty($_POST['lastname'])){
$fname1 = $_POST['firstname'];
$mname1 = $_POST['middlename'];
$lname1=$_POST['lastname'];
$gender1 = $_POST['gender'];
// syntax for SQL UPDATE statement
$query = "UPDATE tbl_personnel SET firstname='$fname1', middlename='$mname1', lastname='$lname1', gender='$gender1' WHERE id = {$id}";
$result = mysql_query($query);
if($result){
$msg = " Successfully Update the record number $id";
$fname = "";
$mname = "";
$lname = "";
$gender = "";
}

}else{
$msg= " All fields are required!";
}
}

?>
<form method="POST">
<h5><?php if(isset($msg)){ echo "<font color = 'RED' >$msg</font>"; }else { }?></h5>
<table>
<tr>
<td>First Name</td>
<td> : <input type="text" name="firstname" value="<?php echo $fname;?>"></td>
</tr>
<tr>
<td>Middle Name</td>
<td> : <input type="text" name="middlename" value="<?php echo $mname;?>"></td>
</tr>
<tr>
<td>Last Name</td>
<td> : <input type="text" name="lastname" value="<?php echo $lname;?>"></td>
</tr>
<tr>
<td>Gender</td>
<td> : <select name="gender">
<option>Male</option>
<option <?php if($gender =="Female") echo "selected";?>>Female</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="update" value="Update"></td>
</tr>
</table>
</form>

<?php
}
// if the link Delete will click this is the code will executed
if(isset($_GET['id_delete'])){
$id = $_GET['id_delete'];
$query_delete = "DELETE FROM tbl_personnel WHERE id = {$id}";
$result_delete = mysql_query($query_delete);
if($result_delete){
echo "ID number : <font color='RED'><b>$id</b></font> Successfully Deleted From DATABASE";
}
}

$table = "<table border=1px; style='padding:2px;'>
<tr>
<td style='padding:5px;font-weight:bold;'>ID</td>
<td style='padding:5px;font-weight:bold;'>First Name</td>
<td style='padding:5px;font-weight:bold;'>Middle Name</td>
<td style='padding:5px;font-weight:bold;'>Last Name</td>
<td style='padding:5px;font-weight:bold;'>Gender</td>
<td style='padding:5px;font-weight:bold;'>Action</td>
</tr>";

$query = "SELECT * FROM tbl_personnel";
$result = mysql_query($query);
$number_rows = mysql_num_rows($result);

// check if the number of rows is greater than 1 or equal. If so, the value from database will fecth and displayed
if($number_rows >= 1){
// fetch all data from database
while($row = mysql_fetch_array($result)){

// Display all data to the table
$table.="<tr>
<td style='padding:5px;'>".$row[0]."</td>
<td style='padding:5px;'>".$row[1]."</td>
<td style='padding:5px;'>".$row[2]."</td>
<td style='padding:5px;'>".$row[3]."</td>
<td style='padding:5px;'>".$row[4]."</td>
<td style='padding:5px;'><a href='?id_edit=".$row[0]."'>Edit</a> <a href='?id_delete=".$row[0]."'>Delete</a></td>
</tr>";

}
$table.="</table>";
}else{
$table.="<tr><td colspan='6' align='center'>No Data</td></tr></table>";
}

echo $table;
?>