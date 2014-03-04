<?php
#require_once('PasswordHash.php');
/**
 * PHP Class to user access (login, register, logout, etc)
 * 
 * <code>< ? php
 * include('user.class.php');
 * $user = new User();
 * ? ></code>
 */

/**
 * User - The main class
 * 
 * @param string $dbName
 * @param string $dbHost 
 * @param string $dbUser
 * @param string $dbPass
 * @param string $dbTable
 */

class User{
  /*Settings*/
  /**
   * The database that we will use
   * var string
   */
  var $dbName = 'seatec';
  /**
   * The database host
   * var string
   */
  var $dbHost = 'localhost';
  /**
   * The database port
   * var int
   */
  var $dbPort = 3306;
  /**
   * The database user
   * var string
   */
  var $dbUser = 'seatec';
  /**
   * The database password
   * var string
   */
  var $dbPass = 'nvruser';
  /**
   * The database table that holds all the information
   * var string
   */
  var $dbTable  = 'users';
  /**
   * The database table that holds all the session information
   * var string
   */
   var $session_table = "session_store";
  /**
   * The session variable ($_SESSION[$sessionVariable]) which will hold the data while the user is logged on
   * var string
   */
  var $sessionVariable = 'id';
  /**
   * The session_cache_expire_time variable (session_cache_expire($session_cache_expire_time)) which will indicate the time to elapse before 
   * a session expires.
   * var int
   */
  var $session_cache_expire_time = 20 ;
  /**
   * The session Inactive variable which will indicate the maximum session idle time allowed before a session expires.
   * var (int)milliseconds
   */
  var $sessionInactive = 1200 ;

  
  /**
   * The method used to encrypt the password. It can be sha1, md5 or nothing (no encryption)
   * var string
   */
   var $passMethod = 'nothing';
  // var $passMethod = 'sha1';
  /**
   * Display errors? Set this to true if you are going to seek for help, or have troubles with the script
   * var bool
   */
  var $displayErrors = true;
  /*Do not edit after this line*/
  var $userID;
  var $dbConn;
  var $userData=array();
  /**
   * Class Constructor
   * 
   * @param string $dbConn
   * @param array $settings
   * @return void
   */
  function User($dbConn = '', $settings = '')
  {
	    if ( is_array($settings) ){
		    foreach ( $settings as $k => $v ){
				    if ( !isset( $this->{$k} ) ) die('Property '.$k.' does not exists. Check your settings.');
				    $this->{$k} = $v;
			}
	    }
	   
          $this->dbConn = ($dbConn=='')? mysql_connect($this->dbHost.":".$this->dbPort, $this->dbUser, $this->dbPass):$dbConn;
	    if ( !$this->dbConn ) die(mysql_error($this->dbConn));
	    mysql_select_db($this->dbName, $this->dbConn)or die(mysql_error($this->dbConn));
	    
            if( !isset( $_SESSION ) ) session_start();
	    if ( !empty($_SESSION[$this->sessionVariable]) )
	    {
		    $this->loadUser( $_SESSION[$this->sessionVariable] );
	    }
  }
  

  function get_user_data($user_id) 
  {
    $res = $this->query("SELECT * FROM `users` WHERE `id` = '$user_id' ",__LINE__);
    if ( mysql_num_rows($res) == 1)
    {
        $Data = mysql_fetch_array($res);
        return $Data;
    }
  return NULL;    
  }



  /**
  	* Login function
  	* @param string $uname
  	* @param string $password
  	* @param bool $loadUser
  	* @return bool
  */
  function login($uname, $password, $remember = false, $loadUser = true)
  {
    	$uname    = $this->escape($uname);
    	$password = $originalPassword = $this->escape($password);
		switch(strtolower($this->passMethod)){
		  case 'sha1':
		  	$password = "SHA1('$password')"; break;
		  case 'md5' :
		  	$password = "MD5('$password')";break;
		  case 'nothing':
		  	$password = "'$password'";
		}
		$res = $this->query("SELECT * FROM `users` 
		WHERE `username` = '$uname' AND `password` = $password LIMIT 1",__LINE__);
		if ( mysql_num_rows($res) == 0)
			return false;
		if ( $loadUser )
		{
			$this->userData = mysql_fetch_array($res);
			$this->userID = $this->userData['id'];
			$_SESSION['ID'] = $this->userID;
			$_SESSION['username'] = $this->userData['username'];
			$_SESSION['role'] = $this->userData['role'];
      #$_SESSION['location'] = $this->userData['location_id'];
			
      $userObj = new stdClass();
      $userObj->role = $this->userData['id'];
      $userObj->validated = TRUE;

			$_SESSION['start'] = time();
			$session_id=session_id();
			#$this->writeSession($session_id);
		}
return $userObj;
  }
  
  /**
  	* Session Manager function
  	* @return bool
  */
  function sessionManager() 
  {
  	session_cache_expire( $this->$session_cache_expire_time );
	session_start();
	
	//$sessID=session_id();
	//$userID=$this->$userID;

	  if(isset($_SESSION['start']) ) 
	  {
	  $session_life = time() - $_SESSION['start'];
			  if($session_life > $this->$sessionInactive)
			  $this->logout("login.php?logout=1");
	  }
	  $_SESSION['start'] = time();

	return true;
  }
  
  /**
  	* comfirm login function
  	* @return bool
  */
  function confirm_logged_in() 
  {
  $sessID=session_id();
  $res=$this->query("SELECT *FROM {$this->session_table} WHERE sessionId='$sessID' AND sessionUserID='{$this->userID}' ");

	if( @mysql_num_rows($res)==0 )
		$this->logout("login.php");
  
	return true;
  }
  
  /**
  	* Write Session function
  	* @param string $session_id
  	* @return bool
  */
  function writeSession($session_id) 
  {
	$userID=$this->userID;
	$res=$this->query("SELECT *FROM {$this->session_table} WHERE sessionUserID='{$this->userID}' ");
	if( @mysql_num_rows($res)==1 )
	$this->query("UPDATE {$this->session_table} SET sessionId='$session_id' WHERE sessionUserID='{$this->userID}'");		
	else
	$this->query("INSERT INTO {$this->session_table} (sessionId,sessionUserID) VALUES('$session_id','{$this->userID}')");
	
	return true;
  }
  /**
  	* Logout function
  	* param string $redirectTo
  	* @return bool
  */
  function logout($redirectTo = '')
  {
    setcookie($this->remCookieName, '', time()-3600);
    $_SESSION['ID'] = '';
    session_destroy();
    $this->userData = '';
    if ( $redirectTo != '' && !headers_sent()){
	   header('Location: '.$redirectTo );
	   exit;//To ensure security
	  }
  }
  
  
    /*
   * Creates a random password. You can use it to create a password or a hash for user activation
   * param int $length
   * param string $chrs
   * return string
   */
  function randomPass($length=10, $chrs = '1234567890qwertyuiopasdfghjklzxcvbnm'){
    for($i = 0; $i < $length; $i++) {
        $pwd .= $chrs{mt_rand(0, strlen($chrs)-1)};
    }
    return $pwd;
  }

  
  
  /**
   * Get user attribute
   * @ param string $attribute
   * @ return string
   */
  function get_attribute($attribute=NULL)
  {
    return empty($this->userData[$this->tbFields[$attribute]]) ? false : $this->userData[$this->tbFields[$attribute]];
  }
  
  
  /*
   * Creates a user account. The array should have the form 'database field' => 'value'
   * @param array $data
   * return int
   */  
  function registerUser($data){
    if (!is_array($data)) $this->error('Data is not an array', __LINE__);
    switch(strtolower($this->passMethod)){
	  case 'sha1':
	  	$password = sha1($data['password']); break;
	  case 'md5' :
	  	$password = "MD5('".$data['password']."')";break;
	  case 'nothing':
	  	$password = $data['password'];
	}
    foreach ($data as $k => $v ) 
        $data[$k] = "'".$this->escape($v)."'";

    $data['password'] = "\"".$password."\"";
    $sql = "INSERT INTO `{$this->dbTable}` (`".implode('`, `', array_keys($data))."`) VALUES (".implode(", ", $data).")";
    $this->query($sql);
	return (int)mysql_insert_id($this->dbConn);
  }
  
  
   function updateUser($id,$updateData) {
  	foreach ($updateData as $key => $value) 
	{
		$field_name=$key;
		$db_query="UPDATE {$this->dbTable} SET $field_name='$value' WHERE id='$id'";
		$result=$this->query($db_query);
	}
	if($result)
	return true;
  }
  /*
  ////////////////////////////////////////////
  // PRIVATE FUNCTIONS
  ////////////////////////////////////////////
  
  /**
  	* SQL query function
  	* @access private
  	* @param string $sql
  	* @return string
  */
  function query($sql, $line = 'Unknown')
  {
    #echo '<b>Query to execute: </b>'.$sql.'<br /><b>Line: </b>'.$line.'<br />';
    mysql_select_db($this->dbName);
	$res = mysql_query($sql, $this->dbConn) ;
	if ( !$res )
		$this->error(mysql_error($this->dbConn), $line);
	return $res;
  }
  

  /**
  	* Produces the result of addslashes() with more safety
  	* @access private
  	* @param string $str
  	* @return string
  */  
  function escape($str) {
    $str = get_magic_quotes_gpc()?stripslashes($str):$str;
    $str = mysql_real_escape_string($str, $this->dbConn);
    return $str;
  }
  
  /**
  	* Error holder for the class
  	* @access private
  	* @param string $error
  	* @param int $line
  	* @param bool $die
  	* @return bool
  */  
  function error($error, $line = '', $die = true) {
    if ( $this->displayErrors )
    	echo '<b>Error: </b>'.$error.'<br /><b>Line: </b>'.($line==''?'Unknown':$line).'<br />';
    if ($die) exit;
    return false;
  }
}
?>