<?php
 # Require the header
 $page_title = "Users"; 	
 require "view/navigation.php";
 require "db_connect.php"; 
 //include("session_function.php");  
?>

<?php
  # Require the common navigation 
  $main_section = "admin";
  $sub_section  = "users";
 // require("common/navigation.php");
?>

<?php
if ($_SESSION['role'] != 1) {
	header("Location:index.php?logout=1");
}
?>

<div id="box">
	<?php
		require_once "classes/user/user.php";
		$user = new User();
		
		if(isset($_POST['register-button'])) {
			$user_data = array(
					 "first_name"	=>	$_POST['reg-fname']
					,"last_name"	=>	$_POST['reg-lname']
					,"username"		=>	$_POST['reg-uname']	
					,"email"		=>	$_POST['reg-email']
					,"password"		=>	$_POST['reg-pword']
				);
			if ($_POST['user_id'] > 0) {
				if ( empty($user_data['password']) ) {
					unset($user_data['password']);
				}

				$saved = $user->updateUser($_POST['user_id'],$user_data);
			}
			else {
				$saved = $user->registerUser($user_data);		
			}


          
		  if($saved) {
		  	echo "<div class=\"green large\">Registration was successful! </div>";
		  	echo "<div style=\"text-align:center;\"><a href=\"index.php\">Click Here</a> to Login.</div>";

		  	header("Location:user_listing.php");
		  }
		  else
		  {
		  	echo "<div class=\"red\">Registration wasn't successful! </div>";
		  }

		}
		else {

		if (isset($_GET['cid'])) {
			$user_id = $_GET['cid'];

			require_once "classes/User.php";
			$user = new User();
			$user_data = $user->get_user_data($user_id);
			$readonly = 'readonly="readonly"';
			// echo "<pre>";
			// print_r($user_data);
		}
		?>
	<div class="inner">
		<form name="register" action="" method="post">
			<input name="user_id" type="hidden" value="<?php echo $user_data['id'] ?>"> 
			<ul>
				<li>
					<label for="reg-fname">First Name</label>
					<input name="reg-fname" id="reg-fname" alt="First Name" class="inputbox" type="text" size="30" maxlength="80" value="<?php echo $user_data['first_name'] ?>"> 
				</li>
				<li>
					<label for="reg-lname">Last Name</label>
					<input name="reg-lname" id="reg-lname" alt="Last Name" class="inputbox" type="text" size="30" maxlength="80" value="<?php echo $user_data['last_name'] ?>"> 
				</li>
				<li>
					<label for="reg-uname">Username</label>
					<input name="reg-uname" <?php echo $readonly ?> id="reg-uname" alt="Username" class="inputbox" type="text" size="30" maxlength="80" value="<?php echo $user_data['username'] ?>"> 
				</li>
				<li>
					<label for="reg-email">E-mail Address</label>
					<input name="reg-email" id="reg-email" alt="E-mail Address" class="inputbox" type="text" size="30" maxlength="80" value="<?php echo $user_data['email'] ?>"> 
				</li>
				<li>
					<label for="reg-pword">Password</label>
					<input name="reg-pword" id="reg-pword" alt="Password" class="inputbox" type="password" size="30" maxlength="80" > 
				</li>
			
				<!-- <li>
					<label for="reg-pword2">Repeat Password</label>
					<input name="reg-pword2" id="reg-pword2" alt="Repeat Password" class="inputbox" type="password" size="30" maxlength="80" > 
				</li> -->
				<li>
					<label for=""></label>
					<input type="reset" id="reset-button" class="button" value="Reset" name="reset-button" style="margin-right:40px;"> 
					<input type="submit" id="register-button" class=" button" value="Save" name="register-button"> 
				</li>
			</ul>
		</form>
	</div>
<?php } ?>
</div>
<!-- Close:: form box div -->

<?php require 'common/footer.php' ?>	
