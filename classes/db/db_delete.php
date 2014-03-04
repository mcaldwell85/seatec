<?php
// connect to database
include 'db_connect.php';

// delete query
$sql = "DELETE FROM users WHERE id = {$_GET['id']}";

if(mysql_query($sql)){
            
    // redirect to index page
    // parameter "action=deleted" is used to show that something was deleted
    header('Location: index.php?action=deleted');

}

else{
    die("SQL: " . $sql . " >> ERROR: ".mysql_error());
}
?>