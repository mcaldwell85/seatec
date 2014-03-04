<?php
include 'db_connect.php';

if($_POST){

    //update the record if the form was submitted
    $sql="UPDATE
            users
        SET 
            firstname='" . mysql_real_escape_string($_POST['firstname']) . "',
            lastname='" . mysql_real_escape_string($_POST['lastname']) . "',
            username='" . mysql_real_escape_string($_POST['username']) . "',
            password='" . mysql_real_escape_string($_POST['password']) . "'
        WHERE 
            id=" . mysql_real_escape_string($_POST['id']);
                
    if(mysql_query($sql)){
        //this will be displayed when the query was successful
        echo "<div>Record was edited.</div>";
    }else{
        die("SQL: " . $sql . " >> ERROR: " . mysql_error());
    }
}

$id=$_REQUEST['id']; //the user id

//this query will select the user data which is to be used to fill up the form
$sql="select * from users where id={$id}";
$rs=mysql_query($sql) or die("SQL: ".$sql." >> ".mysql_error());
$num=mysql_num_rows($rs);

//just a little validation, if a record was found, the form will be shown
//it means that there's an information to be edited
if($num>0){ 
    $row=mysql_fetch_assoc($rs);
    extract($row);
?>
<!--we have our html form here where new user information will be entered-->
<form action='#' method='post' border='0'>
    <table>
        <tr>
            <td>Firstname</td>
            <td><input type='text' name='firstname' value='<?php echo $firstname;  ?>' /></td>
        </tr>
        <tr>
            <td>Lastname</td>
            <td><input type='text' name='lastname' value='<?php echo $lastname;  ?>' /></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type='text' name='username'  value='<?php echo $username;  ?>' /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type='password' name='password'  value='<?php echo $password;  ?>' /></td>
        <tr>
            <td></td>
            <td>
                <!-- so that we could identify what record is to be updated -->
                <input type='hidden' name='id' value='<?php echo $id ?>' /> 
                
                <!-- we will set the action to edit -->
                <input type='hidden' name='action' value='edit' />
                <input type='submit' value='Edit' />
                <a href='index.php'>Back to index</a>
            </td>
        </tr>
    </table>
</form>
<?php
}else{
    echo "User with this id is not found.";
}
?>