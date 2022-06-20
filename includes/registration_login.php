<?php 
// session_start();
	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	// $role = "tenant";

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		global $role;
		// receive all input values from the form
		$fullname = esc($_POST['fullname']);
		$mobile = esc($_POST['mobile']);
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);
		$role = esc($_POST['role']);

		// form validation: ensure that the form is correctly filled
		if (empty($mobile)) {  array_push($errors, "provide your mobile number"); }
		if (empty($fullname)) {  array_push($errors, "provide fullname"); }
		if (empty($username)) {  array_push($errors, "provide username"); }
		if (empty($email)) { array_push($errors, "email is required"); }
		if (empty($password_1)) { array_push($errors, "forgot the password"); }
		if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match");}

		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username) {
			  array_push($errors, "Username already exists");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Email already exists");
			}
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (fullname, username, mobile, email, role, password, created_at, updated_at) 
					  VALUES('$fullname', '$username', '$mobile', '$email', '$role', '$password', now(), now())";
			mysqli_query($conn, $query);

			// get id of created user
			$reg_user_id = mysqli_insert_id($conn); 

			// put logged in user into session array
			$_SESSION['user'] = getUserById($reg_user_id);

			// if user is landlord, redirect to landlord area
			if ( in_array($_SESSION['user']['role'], ["landlord", "manager"])) {
				$_SESSION['message'] = "You are now logged in";
				// redirect to landlord area
				header('location: ' . BASE_URL . 'admin/dashboard.php');
				exit(0);
			} else {
				$_SESSION['message'] = "You are now logged in";
				// redirect to public area
				header('location: index.php');				
				exit(0);
			}
		}
	}

if (isset($_POST['newpassword'])) {
	Forgot_password();
}
if (isset($_POST['setpassword'])) {
	new_password();
}
//set new password 
function new_password(){
	global $conn, $errors;
	if(isset($_POST) & !empty($_POST)){
		// $pwd = bin2hex(openssl_random_pseudo_bytes(4));
		$email = mysqli_real_escape_string($conn, $_GET['email']);
		$password_1 = $_POST['newpwd'];
		$password_2 = $_POST['confirmpwd'];
		if (empty($password_1)) { 
			array_push($errors, "password required");
		}else if ($password_1 != $password_2) { 
			array_push($errors, "Passwords do not match");
		}
		if (count($errors) == 0) {
			$pwd = md5($password_1);
		
			$sql = "UPDATE `users` SET `password`='$pwd' WHERE email = '$email' ";
			$res = mysqli_query($conn, $sql);
			if($res) $_SESSION['message'] = "Password updated";
			else echo mysqli_error($conn);
		}
		
	}	
}
function Forgot_password(){
	global $conn, $errors;
	if(isset($_POST) & !empty($_POST)){
		$receiver = mysqli_real_escape_string($conn, $_POST['email']);
		if (empty($receiver)) {  array_push($errors, "email is required"); }
		else if(!filter_var($receiver, FILTER_VALIDATE_EMAIL)){array_push($errors, "email is not valid"); }
		else{
			
		
		$sql = "SELECT * FROM `users` WHERE email = '$receiver'";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		if($count == 1){
		$r = mysqli_fetch_assoc($res);
		$uName=$r['username'];
		$subject='Reset Password';
		 
		$msg="
        <span>Hi $uName, </span><br>
        <br>
        <span style='margin-top:10px !important;'>Forgot your Password?</span>  <br>
        <span>We received a request to reset the password for your account. </span><br>
        <br>
        <span style='margin-top:10px !important;'>To reset your password, click on the button below: </span><br>
        <br>
        <a href='http://localhost/onlinerentals/reset_password.php?email=$receiver' style='background-color:#192f6a; color:white; outline:none; border:hidden;  padding: 8px 30px; margin-top: 5px !important; text-decoration:none; border-radius:5px'>Reset Password</a>
             
        ";
		$headers = "From: info.onlinerentals@gmail.com";
        $headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
if (mail($receiver, $subject, $msg, $headers)) {
	echo "Email successfully sent to $receiver...";
} else {
	echo "An error occured while sending you a mail";
}
		 
		}else{
		echo "User not found";
		}
	}}
	
	  
}
	// REGISTER USER BY ADMIN
	// REGISTER USER
	if (isset($_POST['reg_user_by_admin'])) {
		global $role;
		// receive all input values from the form
		$fullname = esc($_POST['fullname']);
		$mobile = esc($_POST['mobile']);
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);
		$role = esc($_POST['role']);

		// form validation: ensure that the form is correctly filled
		if (empty($mobile)) {  array_push($errors, "provide your mobile number"); }
		if (empty($fullname)) {  array_push($errors, "provide fullname"); }
		if (empty($username)) {  array_push($errors, "provide username"); }
		if (empty($email)) { array_push($errors, "email is required"); }
		if (empty($password_1)) { array_push($errors, "forgot the password"); }
		if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match");}

		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username) {
			  array_push($errors, "Username already exists");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Email already exists");
			}
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (fullname, username, mobile, email, role, password, created_at, updated_at) 
					  VALUES('$fullname', '$username', '$mobile', '$email', '$role', '$password', now(), now())";
			mysqli_query($conn, $query);

			
				$_SESSION['message'] = "Created successful";
				// redirect to landlord area
				header('location: ' . BASE_URL . 'admin/tenants.php');
				exit(0);
		}
	}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}


	// LOGIN USER
function login(){
	global $conn, $username, $errors;

	// grap form values
	// escape function filters data to be inserted securely inside the conn
	$username = esc($_POST['username']);
	$password = esc($_POST['password']);
	$user_type = esc($_POST['user_type']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}
	if (empty($user_type)) {
		array_push($errors, "Role is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);
     // login landlord
		if ($user_type == "landlord") {
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($conn, $query);
			if (mysqli_num_rows($results) == 1) {
				$logged_in_user = mysqli_fetch_assoc($results);
				$_SESSION['user'] = $logged_in_user;
				if ( in_array($_SESSION['user']['role'], ["landlord"])) {
					$_SESSION['message'] = "You are now logged in";
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/dashboard.php');	
				}	 
			}else {
				array_push($errors, "Wrong username/password combination or you have not registered");
			}
		}
		// login tenant
		if ($user_type == "tenant") {
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($conn, $query);
			if (mysqli_num_rows($results) == 1) {
				$logged_in_user = mysqli_fetch_assoc($results);
				$_SESSION['user'] = $logged_in_user;
				if ( in_array($_SESSION['user']['role'], ["tenant"])) {
					$_SESSION['message'] = "You are now logged in";
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');
				}		 
			}else {
				array_push($errors, "Wrong username/password combination or you have not registered");
			}
		}
		// login manager
		if ($user_type == "manager") {
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($conn, $query);
			if (mysqli_num_rows($results) == 1) {
				$logged_in_user = mysqli_fetch_assoc($results);
				$_SESSION['user'] = $logged_in_user;
				if ( in_array($_SESSION['user']['role'], ["manager"])) {
					$_SESSION['message'] = "You are now logged in";
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/dashboard.php');	
				}	 
			}else {
				array_push($errors, "Wrong username/password combination or you have not registered");
			}
		}
	}
}

	// escape value from form
	function esc(String $value)
	{	
		// bring the global conn connect object into function
		global $conn;

		$val = trim($value); // remove empty space sorrounding string
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Get user info from user id
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		// returns user in an array format: 
		// ['id'=>1 'username' => 'Awa', 'email'=>'a@a.com', 'password'=> 'mypass']
		return $user; 
	}
?>