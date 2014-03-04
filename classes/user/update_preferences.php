<?php
include 'db_connect.php';

if($_POST){

    //update the record if the form was submitted
    $sql="UPDATE
            preferences
        SET 
            gridWidth='" . mysql_real_escape_string($_POST['gridWidth']) . "',
            gridHeight='" . mysql_real_escape_string($_POST['gridHeight']) . "',
            defaultSite='" . mysql_real_escape_string($_POST['defaultSite']) . "',
            exportPath='" . mysql_real_escape_string($_POST['exportPath']) . "'
        WHERE 
            id=" . mysql_real_escape_string($_POST['id']);
                
    if(mysql_query($sql)){
        //this will be displayed when the query was successful
        echo "<div>Preferences updated.</div>";
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
            <td>Live View Grid Height:</td>
            <td><input type='text' name='gridHeight' value='<?php echo $gridHeight;  ?>' /></td>
        </tr>
        <tr>
            <td>Live View Grid Width:</td>
            <td><input type='text' name='gridWidth' value='<?php echo $gridWidth;  ?>' /></td>
        </tr>
        <tr>
            <td>Default Site:</td>
            <td><input type='select' name='defaultSite'  value='<?php echo $defaultSite;  ?>' /></td>
        </tr>
        <tr>
            <td>Export Path: </td>
            <td><input type='text' name='exportPath'  value='<?php echo $exportPath;  ?>' /></td>
        <tr>
            <td></td>
            <td>
                <!-- so that we could identify what record is to be updated -->
                <input type='hidden' name='id' value='<?php echo $id ?>' /> 
                
                <!-- we will set the action to edit -->
                <input type='hidden' name='action' value='edit' />
                <input type='submit' value='Edit' />
                <a href='preferences.php'>Back to Preferences.</a>
            </td>
        </tr>
    </table>
</form>
<?php
}else{
    echo "User with this id is not found.";
}
?>