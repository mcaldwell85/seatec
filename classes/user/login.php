<? 
/*============== 
:- Sample Usage: 
============== 

If($_POST['login']) { 
    If(auth_user($_POST['username'],$_POST['password'])) { 
        Echo("You are now logged in. Click here to go to your page"); 
        exit; 
    } Else { 
        Echo("Login Failed! Please try again. <br /><br />"); 
    } 
} 

login_form(); //display the login form 
?> 

:- ============== 
:- Put this at the top of files you want to protect.: 
:- ============== 

<? 
If(!is_logged_in()) { 
    Echo("Please login first"); 
    login_form(); //display the login form 
    exit; 

} 
// Display protected content after calling is_logged_in(); 

*/ 
?> 

/*===================== 
The Script: 
=====================*/ 

<? 
function auth_user($username,$password) { 

    //This assumes you have a mysql table setup with user accounts. 

    $query=mysql_query("SELECT username,password FROM tbl_name WHERE username='".addslashes($username)."' AND password='".addslashes($password)."' LIMIT 1");
    If(mysql_num_rows($query) > 0) { 

        setcookie("loggedin",true,time()+170000); 
        $_SESSION['loggedin']=true; 

        return true; 

    } Else { 
        return false; 

    } 
    return false; 
} 

function is_logged_in() { 

    If(($_COOKIE['loggedin']==true) OR ($_SESSION['loggedin']==true)) { 
        return true; 
    } Else { 
        return false; 
    } 
} 


function login_form() { 
?> 
<form method="post" action="<?Echo($_SERVER['PHP_SELF']);?> 
Username: <input type="text" name="username" value="" /><br /> 
Password: <input type="password" name="password" value="" /><br /> 
<input type="hidden" name="login" value="true" /> 
<input type="submit" name="submit" value=" Auth Me " /> 
</form> 
<? 
} 

?>