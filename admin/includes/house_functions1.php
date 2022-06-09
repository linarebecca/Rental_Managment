<?php 
// House variables
$house_id = 0;
$isEditingHouse = false;
$published = 0;
$title = "";
$price = "";
$house_slug = "";
$body = "";
$featured_image = "";
$house_floor = "";

/* - - - - - - - - - - 
-  House functions
- - - - - - - - - - -*/
// get all houses from DB
function getAllHouses()
{
	// connect to database
	$conn = mysqli_connect("localhost", "root", "", "onlinerentalsdb");
	// check if user in the logged in session exists 
	if (isset($_SESSION['user'])) {
		$user_role = $_SESSION['user'];
		$query = "SELECT * FROM users WHERE id = $user_role ";
		$select_user_role = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($select_user_role)) {
		$user_type = $row['role'];
		}
	}
	echo var_dump($user_type);

	// landlord can view all houses
	// Managers can only view the houses they create
	// if ($_SESSION['user']['role'] == "landlord") {
	// if ($user_type == "landlord") {
		$sql = "SELECT * FROM houses JOIN house_floors ON houses.id=house_floors.house_id";
	// } 
	// if ($user_type == "manager") {
		// $user_id = $_SESSION['user']['id'];
		// $user_id = $user_role;
		// $sql = "SELECT * FROM houses JOIN floors ON houses.floor_id=houses.id";
	// }
	$result = mysqli_query($conn, $sql);
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_houses = array();
	foreach ($houses as $house) {
		$house['manager'] = getHouseAgentById($house['user_id']);
		array_push($final_houses, $house);
	}
	return $final_houses;
}
// get the author/username of a house
function getHouseAgentById($user_id)
{
	global $conn;
	$sql = "SELECT username FROM users WHERE id=$user_id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		// return username
		return mysqli_fetch_assoc($result)['username'];
	} else {
		return null;
	}
}
/* - - - - - - - - - - 
-  House actions
- - - - - - - - - - -*/
// if user clicks the create house button
if (isset($_POST['create_house'])) { createHouse($_POST); }
// if user clicks the Edit house button
if (isset($_GET['edit-house'])) {
	$isEditingHouse = true;
	$house_id = $_GET['edit-house'];
	editHouse($house_id);
}
// if user clicks the update house button
if (isset($_POST['update_house'])) {
	updateHouse($_POST);
}
// if user clicks the Delete house button
if (isset($_GET['delete-house'])) {
	$house_id = $_GET['delete-house'];
	deleteHouse($house_id);
}

/* - - - - - - - - - - 
-  House functions
- - - - - - - - - - -*/
function createHouse($request_values)
	{
		global $conn, $errors, $title, $price, $featured_image, $floor_id, $body, $published;
		$title = esc($request_values['title']);
		$price = esc($request_values['price']);
		$body = htmlentities(esc($request_values['body']));
		if (isset($request_values['floor_id'])) {
			$floor_id = esc($request_values['floor_id']);
		}
		if (isset($request_values['publish'])) {
			$published = esc($request_values['publish']);
		}
		// create slug: if title is "Three Bedrooms", return "three-bedrooms" as slug
		$house_slug = makeSlug($title);
		// validate form
		if (empty($title)) { array_push($errors, "House title is required"); }
		if (empty($price)) { array_push($errors, "House Price is required"); }
		if (empty($body)) { array_push($errors, "House body is required"); }
		if (empty($floor_id)) { array_push($errors, "House floor is required"); }
		// Get image name
	  	$featured_image = $_FILES['featured_image']['name'];
	  	if (empty($featured_image)) { array_push($errors, "Featured image is required"); }
	  	// image file directory
	  	$target = "../static/images/" . basename($featured_image);
	  	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
	  		array_push($errors, "Failed to upload image. Please check file settings for your server");
	  	}
		// Ensure that no house is saved twice. 
		$house_check_query = "SELECT * FROM houses WHERE slug='$house_slug' LIMIT 1";
		$result = mysqli_query($conn, $house_check_query);

		if (mysqli_num_rows($result) > 0) { // if house exists
			array_push($errors, "A house already exists with that title.");
		}
		// create house if there are no errors in the form
		if (count($errors) == 0) {
			$query = "INSERT INTO houses (user_id, floor_id, title, slug, price, image, body, published, created_at, updated_at) VALUES(1, '$floor_id', '$title', '$house_slug', $price, '$featured_image', '$body', $published, now(), now())";
			if(mysqli_query($conn, $query)){ // if house created successfully
				$inserted_house_id = mysqli_insert_id($conn);
				// create relationship between house and floor
				// $sql = "INSERT INTO house_floors (house_id, floor_id) VALUES($inserted_house_id, $floor_id)";
				// mysqli_query($conn, $sql);

				$_SESSION['message'] = "House created successfully";
				header('location: houses.php');
				exit(0);
			}
		}
	}

	/* * * * * * * * * * * * * * * * * * * * *
	* - Takes house id as parameter
	* - Fetches the house from database
	* - sets house fields on form for editing
	* * * * * * * * * * * * * * * * * * * * * */
	function editHouse($role_id)
	{
		global $conn, $title, $house_slug, $price, $body, $published, $isEditingHouse, $house_id;
		$sql = "SELECT * FROM houses WHERE id=$role_id LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$house = mysqli_fetch_assoc($result);
		// set form values on the form to be updated
		$title = $house['title'];
		$price = $house['price'];
		$body = $house['body'];
		$published = $house['published'];
	}

	function updateHouse($request_values)
	{
		global $conn, $errors, $house_id, $title, $price, $featured_image, $floor_id, $body, $published;

		$title = esc($request_values['title']);
		$price = esc($request_values['price']);
		$body = esc($request_values['body']);
		$house_id = esc($request_values['house_id']);
		if (isset($request_values['floor_id'])) {
			$floor_id = esc($request_values['floor_id']);
		}
		if (isset($request_values['publish'])) {
			$published = esc($request_values['publish']);
		}
		// create slug: if title is "Three Bedrooms", return "three-bedrooms" as slug
		$house_slug = makeSlug($title);

		if (empty($title)) { array_push($errors, "House title is required"); }
		if (empty($price)) { array_push($errors, "House price is required"); }
		if (empty($body)) { array_push($errors, "House body is required"); }
		// if new featured image has been provided
		if (isset($_POST['featured_image'])) {
			// Get image name
		  	$featured_image = $_FILES['featured_image']['name'];
		  	// image file directory
		  	$target = "../static/images/" . basename($featured_image);
		  	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		  		array_push($errors, "Failed to upload image. Please check file settings for your server");
		  	}
		}

		// register floor if there are no errors in the form
		if (count($errors) == 0) {
			$query = "UPDATE houses SET title='$title', slug='$house_slug', price='$price', views=0, image='$featured_image', body='$body', published=$published, updated_at=now() WHERE id=$house_id";
			// attach floor to house on house_floors table
			if(mysqli_query($conn, $query)){ // if house created successfully
				if (isset($floor_id)) {
					$inserted_house_id = mysqli_insert_id($conn);
					// create relationship between house and floor
					$sql = "INSERT INTO house_floors (house_id, floor_id) VALUES($inserted_house_id, $floor_id)";
					mysqli_query($conn, $sql);
					$_SESSION['message'] = "House created successfully";
					header('location: houses.php');
					exit(0);
				}
			}
			$_SESSION['message'] = "House updated successfully";
			header('location: houses.php');
			exit(0);
		}
	}
	// delete house
	function deleteHouse($house_id)
	{
		global $conn;
		$sql = "DELETE FROM houses WHERE id=$house_id";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['message'] = "House successfully deleted";
			header("location: houses.php");
			exit(0);
		}
	}

    // if user clicks the publish house button
if (isset($_GET['publish']) || isset($_GET['unpublish'])) {
	$message = "";
	if (isset($_GET['publish'])) {
		$message = "House published successfully";
		$house_id = $_GET['publish'];
	} else if (isset($_GET['unpublish'])) {
		$message = "Post successfully unpublished";
		$house_id = $_GET['unpublish'];
	}
	togglePublishHouse($house_id, $message);
}
// unpublish house
function togglePublishHouse($house_id, $message)
{
	global $conn;
	$sql = "UPDATE houses SET published=!published WHERE id=$house_id";
	
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = $message;
		header("location: houses.php");
		exit(0);
	}
}

?>