<?php
// connect to database
include 'db/db_connect.php';

// If Button Save was click this is the code will executed
if(isset($_POST['save'])){
// check fields for wheither not empty or empty
if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']) ){

// initialize the variable to be the value of the textbox
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

//Sql syntax for INSERT Statement
$query = "INSERT INTO users (id,firstname,lastname,email,password,role) values (DEFAULT,'".$fname."','".$lname."','".$email."','".$password."','".$role."')";
$result = mysql_query($query);
if($result){
$msg = " Successfully Added ($fname $lname).";
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
<td>Last Name</td>
<td> : <input type="text" name="lastname"></td>
</tr>
<tr>
<td>Email</td>
<td> : <input type="text" name="email"></td>
</tr>
<tr>
<td>Password</td>
<td> : <input type="password" name="password"></td>
</tr>
<td> : <select name="role">
<option value="2">Admin</option>
<option value="1">Power User</option>
<option value="0">Viewer</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="save" value="Save"></td>
</tr>
</table>
</form>