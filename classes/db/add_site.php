<?php
// connect to database
include 'db_connect.php';

// If Button Save was click this is the code will executed
if(isset($_POST['save'])){
// check fields for wheither not empty or empty
if(!empty($_POST['firstname']) && !empty($_POST['middlename']) && !empty($_POST['lastname'])){

// initialize the variable to be the value of the textbox
$fname = $_POST['firstname'];
$mname = $_POST['middlename'];
$lname=$_POST['lastname'];
$gender = $_POST['gender'];

//Sql syntax for INSERT Statement
$query = "INSERT INTO tbl_personnel (firstname,middlename,lastname,gender) values ('".$fname."','".$mname."','".$lname."','".$gender."')";
$result = mysql_query($query);
if($result){
$msg = " Successfully Save New Personnel ($fname $mname $lname)";
}

}else{
$msg= " All fields are required!";
}
}
?>

//Basic HTML Form
<form method="POST">
<h5><?php if(isset($msg)){ echo "<font color = 'RED' >$msg</font>"; }else { }?></h5>
<table>
<tr>
<td>First Name</td>
<td> : <input type="text" name="firstname"></td>
</tr>
<tr>
<td>Middle Name</td>
<td> : <input type="text" name="middlename"></td>
</tr>
<tr>
<td>Last Name</td>
<td> : <input type="text" name="lastname"></td>
</tr>
<tr>
<td>Gender</td>
<td> : <select name="gender">
<option>Male</option>
<option>Female</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="save" value="Save"></td>
</tr>
</table>
</form>