<?php 
// landlord user variables
$landlord_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";
// Floors variables
$floor_id = 0;
$isEditingFloor = false;
$floor_name = "";
// general variables
$errors = [];

/* - - - - - - - - - - 
-  landlord users actions
- - - - - - - - - - -*/
// if user clicks the create landlord button
if (isset($_POST['create_landlord'])) {
	createlandlord($_POST);
}
// if user clicks the Edit landlord button
if (isset($_GET['edit-landlord'])) {
	$isEditingUser = true;
	$landlord_id = $_GET['edit-landlord'];
	editlandlord($landlord_id);
}
// if user clicks the update landlord button
if (isset($_POST['update_landlord'])) {
	updatelandlord($_POST);
}
// if user clicks the Delete landlord button
if (isset($_GET['delete-landlord'])) {
	$landlord_id = $_GET['delete-landlord'];
	deletelandlord($landlord_id);
}


/* - - - - - - - - - - 
-  Floor actions
- - - - - - - - - - -*/
// if user clicks the create floor button
if (isset($_POST['create_floor'])) { createFloor($_POST); }
// if user clicks the Edit floor button
if (isset($_GET['edit-floor'])) {
	$isEditingFloor = true;
	$floor_id = $_GET['edit-floor'];
	editFloor($floor_id);
}
// if user clicks the update topic button
if (isset($_POST['update_floor'])) {
	updateFloor($_POST);
}
// if user clicks the Delete topic button
if (isset($_GET['delete-floor'])) {
	$floor_id = $_GET['delete-floor'];
	deleteFloor($floor_id);
}
/* - - - - - - - - - - - -
-  landlord users functions
- - - - - - - - - - - - -*/
/* * * * * * * * * * * * * * * * * * * * * * *
* - Receives new landlord data from form
* - Create new landlord user
* - Returns all landlord users with their roles 
* * * * * * * * * * * * * * * * * * * * * * */
function createlandlord($request_values){
	global $conn, $errors, $role, $username, $email;
	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password = esc($request_values['password']);
	$passwordConfirmation = esc($request_values['passwordConfirmation']);

	if(isset($request_values['role'])){
		$role = esc($request_values['role']);
	}
	// form validation: ensure that the form is correctly filled
	if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
	if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
	if (empty($role)) { array_push($errors, "Role is required for landlord users");}
	if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }
	if ($password != $passwordConfirmation) { array_push($errors, "The two passwords do not match"); }
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
		$password = md5($password);//encrypt the password before saving in the database
		$query = "INSERT INTO users (username, email, role, password, created_at, updated_at) 
				  VALUES('$username', '$email', '$role', '$password', now(), now())";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "landlord user created successfully";
		header('location: users.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes landlord id as parameter
* - Fetches the landlord from database
* - sets landlord fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editlandlord($landlord_id)
{
	global $conn, $username, $role, $isEditingUser, $landlord_id, $email;

	$sql = "SELECT * FROM users WHERE id=$landlord_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$landlord = mysqli_fetch_assoc($result);

	// set form values ($username and $email) on the form to be updated
	$username = $landlord['username'];
	$email = $landlord['email'];
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Receives landlord request from form and updates in database
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function updatelandlord($request_values){
	global $conn, $errors, $role, $username, $isEditingUser, $landlord_id, $email;
	// get id of the landlord to be updated
	$landlord_id = $request_values['landlord_id'];
	// set edit state to false
	$isEditingUser = false;


	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password = esc($request_values['password']);
	$passwordConfirmation = esc($request_values['passwordConfirmation']);
	if(isset($request_values['role'])){
		$role = $request_values['role'];
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		//encrypt the password (security purposes)
		$password = md5($password);

		$query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE id=$landlord_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "landlord user updated successfully";
		header('location: users.php');
		exit(0);
	}
}
// delete landlord user 
function deletelandlord($landlord_id) {
	global $conn;
	$sql = "DELETE FROM users WHERE id=$landlord_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "User successfully deleted";
		header("location: users.php");
		exit(0);
	}
}


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Returns all tenants users and their corresponding roles
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getTenantUsers(){
	global $conn;
	$sql = "SELECT * FROM house_deposit_tenant JOIN users ON house_deposit_tenant.user_id=users.id JOIN houses ON house_deposit_tenant.house_id=houses.id";
	$result = mysqli_query($conn, $sql);
	$tenants = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $tenants;
}
/* * * * * * * * * * * * * * * * * * * * *
* - Escapes form submitted value, hence, preventing SQL injection
* * * * * * * * * * * * * * * * * * * * * */
function esc(String $value){
	// bring the global db connect object into function
	global $conn;
	// remove empty space sorrounding string
	$val = trim($value); 
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}
// Receives a string like 'Some Sample String'
// and returns 'some-sample-string'
function makeSlug(String $string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

/* - - - - - - - - - - 
-  Floors functions
- - - - - - - - - - -*/
// get all floors from DB
function getAllFloors() {
	global $conn;
	$sql = "SELECT * FROM floors";
	$result = mysqli_query($conn, $sql);
	$floors = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $floors;
}
function createFloor($request_values){
	global $conn, $errors, $floor_name;
	$floor_name = esc($request_values['floor_name']);
	// create slug: if floor is "Floor One", return "floor-one" as slug
	$floor_slug = makeSlug($floor_name);
	// validate form
	if (empty($floor_name)) { 
		array_push($errors, "Floor name required"); 
	}
	// Ensure that no floor is saved twice. 
	$floor_check_query = "SELECT * FROM floors WHERE slug='$floor_slug' LIMIT 1";
	$result = mysqli_query($conn, $floor_check_query);
	if (mysqli_num_rows($result) > 0) { // if floor exists
		array_push($errors, "Floor already exists");
	}
	// register floor if there are no errors in the form
	if (count($errors) == 0) {
		$query = "INSERT INTO floors (name, slug) 
				  VALUES('$floor_name', '$floor_slug')";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Floor created successfully";
		header('location: floors.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes floor id as parameter
* - Fetches the floor from database
* - sets floor fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editFloor($floor_id) {
	global $conn, $floor_name, $isEditingFloor, $floor_id;
	$sql = "SELECT * FROM floors WHERE id=$floor_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$floor = mysqli_fetch_assoc($result);
	// set form values ($floor_name) on the form to be updated
	$floor_name = $floor['name'];
}
function updateFloor($request_values) {
	global $conn, $errors, $floor_name, $floor_id;
	$floor_name = esc($request_values['floor_name']);
	$floor_id = esc($request_values['floor_id']);
	// create slug: if floor is "Floor One", return "floor-one" as slug
	$floor_slug = makeSlug($floor_name);
	// validate form
	if (empty($floor_name)) { 
		array_push($errors, "Floor name required"); 
	}
	// register floor if there are no errors in the form
	if (count($errors) == 0) {
		$query = "UPDATE floors SET name='$floor_name', slug='$floor_slug' WHERE id=$floor_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Floor updated successfully";
		header('location: floors.php');
		exit(0);
	}
}
// delete floor 
function deleteFloor($floor_id) {
	global $conn;
	$sql = "DELETE FROM floors WHERE id=$floor_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "Floor successfully deleted";
		header("location: floors.php");
		exit(0);
	}
}
?>