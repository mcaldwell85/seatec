<?php

if($_POST){

    //include database configuration
    include 'db_connect.php';

    //sql insert statement
    $sql="INSERT INTO users 
            ( firstname, lastname, username, password ) 
        VALUES 
            ( '". mysql_real_escape_string( $_POST['firstname'] ) . "', 
            '" . mysql_real_escape_string( $_POST['lastname'] ) . "', 
            '". mysql_real_escape_string( $_POST['username'] ) . "', 
            '". mysql_real_escape_string( $_POST['password'] ) . "')";

    //execute query
    if(mysql_query($sql)){
        //if successful query
        echo "New record was saved.";
    }else{
        //if query failed
        die("SQL: " . $sql . " >> ERROR: " . mysql_error());
    }
}
?>

<!--we have our html form here where user information will be entered-->
<form action='#' method='post' border='0'>
    <table>
        <tr>
            <td>Firstname</td>
            <td><input type='text' name='firstname' /></td>
        </tr>
        <tr>
            <td>Lastname</td>
            <td><input type='text' name='lastname' /></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type='text' name='username' /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type='password' name='password' /></td>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' />
                <a href='index.php'>Back to index</a>
            </td>
        </tr>
    </table>
</form>