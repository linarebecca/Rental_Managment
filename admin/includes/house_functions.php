<?php 
//variables for house
$house_id = 0;
$isEditingHouse = false;
$published = 0;
$title = "";
$price = "";
$house_slug = "";
$body = "";
$featured_image = "";
$house_floor = "";

// house functions
// get all houses from DB
function getAllHouses()
{
	global $conn;

    if (isset($_SESSION['user'])) {
		$user_role = $_SESSION['user']['id'];
		$query = "SELECT * FROM users WHERE id = $user_role ";
		$select_user_role = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($select_user_role)) {
		$user_type = $row['role'];
		}
	}
	
	// Admin can view all Houses
	// if ($user_type == "landlord") {
		$sql = "SELECT * FROM houses";
	// } elseif ($user_type== "manager") {
	// 	$user_id = $_SESSION['user']['id'];
	// 	$sql = "SELECT * FROM houses WHERE user_id=$user_id";
	// }
	$result = mysqli_query($conn, $sql);
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_houses = array();
	foreach ($houses as $house) {
		$house['manager'] = getHouseManagerById($house['user_id']);
		array_push($final_houses, $house);
	}
	return $final_houses;
}

// house report
function getAllHousesReport()
{
	global $conn;

    if (isset($_SESSION['user'])) {
		$user_role = $_SESSION['user']['id'];
		$query = "SELECT * FROM users WHERE id = $user_role ";
		$select_user_role = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($select_user_role)) {
		$user_type = $row['role'];
		}
	}
	
	// Admin can view all Houses
	// if ($user_type == "landlord") {
		$sql = "SELECT * FROM houses JOIN house_floors ON house_floors.house_id=houses.id JOIN floors ON house_floors.floor_id=floors.id";
	// } elseif ($user_type== "manager") {
	// 	$user_id = $_SESSION['user']['id'];
	// 	$sql = "SELECT * FROM houses WHERE user_id=$user_id";
	// }
	$result = mysqli_query($conn, $sql);
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_houses = array();
	foreach ($houses as $house) {
		$house['manager'] = getHouseManagerById($house['user_id']);
		array_push($final_houses, $house);
	}
	return $final_houses;
}

// VACANTS

// house report
function getAllHousesReportVacant()
{
	global $conn;

    if (isset($_SESSION['user'])) {
		$user_role = $_SESSION['user']['id'];
		$query = "SELECT * FROM users WHERE id = $user_role ";
		$select_user_role = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($select_user_role)) {
		$user_type = $row['role'];
		}
	}
	
		$sql = "SELECT * FROM houses JOIN house_floors ON house_floors.house_id=houses.id JOIN floors ON house_floors.floor_id=floors.id WHERE houses.published = 1";

	$result = mysqli_query($conn, $sql);
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_houses = array();
	foreach ($houses as $house) {
		$house['manager'] = getHouseManagerById($house['user_id']);
		array_push($final_houses, $house);
	}
	return $final_houses;
}

// occupied houses

// house report
function getAllHousesReportOccupied()
{
	global $conn;

    if (isset($_SESSION['user'])) {
		$user_role = $_SESSION['user']['id'];
		$query = "SELECT * FROM users WHERE id = $user_role ";
		$select_user_role = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($select_user_role)) {
		$user_type = $row['role'];
		}
	}
	
		$sql = "SELECT * FROM houses JOIN house_floors ON house_floors.house_id=houses.id JOIN floors ON house_floors.floor_id=floors.id WHERE houses.published = 0";

	$result = mysqli_query($conn, $sql);
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_houses = array();
	foreach ($houses as $house) {
		$house['manager'] = getHouseManagerById($house['user_id']);
		array_push($final_houses, $house);
	}
	return $final_houses;
}

// vacant filter report

// house report
function getAllHousesReportVacantFilter()
{
	global $conn;

    if (isset($_SESSION['user'])) {
		$user_role = $_SESSION['user']['id'];
		$query = "SELECT * FROM users WHERE id = $user_role ";
		$select_user_role = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($select_user_role)) {
		$user_type = $row['role'];
		}
	}
	if (isset($_GET['house_label'])) {
		$house_label = $_GET['house_label'];
	}
		$sql = "SELECT * FROM houses JOIN house_floors ON house_floors.house_id=houses.id JOIN floors ON house_floors.floor_id=floors.id WHERE houses.published = 1 AND houses.slug LIKE '%$house_label%'";

	$result = mysqli_query($conn, $sql);
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_houses = array();
	foreach ($houses as $house) {
		$house['manager'] = getHouseManagerById($house['user_id']);
		array_push($final_houses, $house);
	}
	return $final_houses;
}

// occupied report filter

// house report
function getAllHousesReportOccupiedFilter()
{
	global $conn;

    if (isset($_SESSION['user'])) {
		$user_role = $_SESSION['user']['id'];
		$query = "SELECT * FROM users WHERE id = $user_role ";
		$select_user_role = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($select_user_role)) {
		$user_type = $row['role'];
		}
	}
	if (isset($_GET['house_label'])) {
		$house_label = $_GET['house_label'];
	}
		$sql = "SELECT * FROM houses JOIN house_floors ON house_floors.house_id=houses.id JOIN floors ON house_floors.floor_id=floors.id WHERE houses.published = 0 AND houses.slug LIKE '%$house_label%'";

	$result = mysqli_query($conn, $sql);
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_houses = array();
	foreach ($houses as $house) {
		$house['manager'] = getHouseManagerById($house['user_id']);
		array_push($final_houses, $house);
	}
	return $final_houses;
}


function getAllHousesFilterReport()
{
	global $conn;

    if (isset($_SESSION['user'])) {
		$user_role = $_SESSION['user']['id'];
		$query = "SELECT * FROM users WHERE id = $user_role ";
		$select_user_role = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($select_user_role)) {
		$user_type = $row['role'];
		}
	}

	if (isset($_GET['floor_name'])) {
		$floor_name = $_GET['floor_name'];
	}
	
	// Admin can view all Houses
	// if ($user_type == "landlord") {
		$sql = "SELECT * FROM houses JOIN house_floors ON house_floors.house_id=houses.id JOIN floors ON house_floors.floor_id=floors.id WHERE floors.name LIKE '%$floor_name%'";
	// } elseif ($user_type== "manager") {
	// 	$user_id = $_SESSION['user']['id'];
	// 	$sql = "SELECT * FROM houses WHERE user_id=$user_id";
	// }
	$result = mysqli_query($conn, $sql);
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_houses = array();
	foreach ($houses as $house) {
		$house['manager'] = getHouseManagerById($house['user_id']);
		array_push($final_houses, $house);
	}
	return $final_houses;
}

// get the manager/username of a house
function getHouseManagerById($user_id)
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
-  house actions
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
		// create slug: if title is "House one", return "house-one" as slug
		$house_slug = makeSlug($title);
		// validate form
		if (empty($title)) { array_push($errors, "House title is required"); }
        if (empty($price)) { array_push($errors, "House price is required"); }
		if (empty($body)) { array_push($errors, "House body is required"); }
		if (empty($floor_id)) { array_push($errors, "House Floor is required"); }
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
			$query = "INSERT INTO houses (user_id, title, price, slug, image, body, published, created_at, updated_at) VALUES(1, '$title', '$price', '$house_slug', '$featured_image', '$body', $published, now(), now())";
			if(mysqli_query($conn, $query)){ // if house created successfully
				$inserted_house_id = mysqli_insert_id($conn);
				// create relationship between house and floor
				$sql = "INSERT INTO house_floors (house_id, floor_id) VALUES($inserted_house_id, $floor_id)";
				mysqli_query($conn, $sql);

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
		global $conn, $title, $price, $house_slug, $featured_image, $body, $published, $isEditingHouse, $house_id;
		$sql = "SELECT * FROM houses WHERE id=$role_id LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$house = mysqli_fetch_assoc($result);
		// set form values on the form to be updated
		$title = $house['title'];
        $price = $house['price'];
		$body = $house['body'];
		$featured_image = ['image'];
		$published = $house['published'];
	}

	function updateHouse($request_values)
	{
		global $conn, $errors, $house_id, $title, $price, $featured_image, $floor_id, $body, $published;

		$title = esc($request_values['title']);
        $price = esc($request_values['price']);
		$body = esc($request_values['body']);
		$house_id = esc($request_values['house_id']);
		$room_image = $_FILES['featured_image']['name'];
        $room_image_temp = $_FILES['featured_image']['tmp_name'];
    
		if (isset($request_values['floor_id'])) {
			$floor_id = esc($request_values['floor_id']);
		}
		// create slug: if title is "House one", return "house-one" as slug
		$house_slug = makeSlug($title);

		if (empty($title)) { array_push($errors, "House title is required"); }
        if (empty($price)) { array_push($errors, "House price is required"); }
		if (empty($body)) { array_push($errors, "House body is required"); }
		// if new featured image has been provided
		// if (isset($_POST['featured_image'])) {
		// 	// Get image name
		//   	$featured_image = $_FILES['featured_image']['name'];
		//   	// image file directory
		//   	$target = "../static/images/" . basename($featured_image);
		//   	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		//   		array_push($errors, "Failed to upload image. Please check file settings for your server");
		//   	}
		// }

		move_uploaded_file($room_image_temp, "../static/images/$room_image");
		// KEEPING THE IMAGE FROM DISAPEARING
		if(empty($room_image)) {
		
		$query = "SELECT * FROM houses WHERE id = $house_id ";
		$select_image = mysqli_query($conn,$query);
			
		while($row = mysqli_fetch_array($select_image)) {
			
		$room_image = $row['image'];
		
		}
	}

		// register floor if there are no errors in the form
		if (count($errors) == 0) {
			$query = "UPDATE houses SET title='$title', price='$price', slug='$house_slug', views=0, image='$room_image', body='$body', published=$published, updated_at=now() WHERE id=$house_id";
			// attach floor to house on house_floors table
			if(mysqli_query($conn, $query)){ // if house created successfully
				if (isset($floor_id)) {
					$inserted_house_id = mysqli_insert_id($conn);
					// create relationship between house and floor
					$sql = "INSERT INTO house_floors (house_id, floor_id) VALUES($inserted_house_id, $floor_id)";
					mysqli_query($conn, $sql);
					$_SESSION['message'] = "House Updated successfully";
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
		$message = "House successfully unpublished";
		$house_id = $_GET['unpublish'];
	}
	togglePublishhouse($house_id, $message);
}
// Unpublish house
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
// get all tenant subscribers
function getAllSubscribers() {
	global $conn;
	$sql = "SELECT * FROM users WHERE role = 'tenant'";
	$result = mysqli_query($conn, $sql);
	$subscribers = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $subscribers;
}
// save depositedhouse details
if(isset($_POST['mpesa_btn'])) {
	global $conn;
	// $user_id = $_POST['user_id'];
	// $house_slug = $_POST['house_slug'];
	$house_slug = mysqli_real_escape_string($conn,$_POST['house_slug']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

	// $deposit_amount = mysqli_query($conn, "SELECT price FROM houses WHERE slug = $house_price");
	// print_r($deposit_amount);
	$deposit_amount = 0;
	if (!empty($house_slug) && isset($_GET[$house_slug])) {
		$query = "SELECT * FROM houses WHERE slug = $house_slug ";
		$select_price = mysqli_query($db,$query);
			
		while($row = mysqli_fetch_array($select_price)) {
			
		$deposit_amount = $row['price'];
		
		}
	}
	$mode_of_pay = 'MPESA';
	$mpesa_code = $_POST['mpesa_code'];
	$query = "INSERT INTO house_deposit_tenant(user_id,house_slug,deposit_amount,mode_of_pay,pay_code,created_at) ";
	$query .= "VALUES('{$user_id}','{$house_slug}','{$deposit_amount}','{$mode_of_pay}','{$mpesa_code}',now()) ";
	$create_query = mysqli_query($conn,$query);
	$house_det = isset($_SESSION['deposited']);
	// echo var_dump($house_det);

	if (!$create_query) {
	die('QUERY FAILED' . mysqli_error($conn));
	}
	header("Location: tenants.php");

}
// card insertion deposit
if(isset($_POST['card_btn'])) {
	global $conn;
	$user_id = $_POST['user_id'];
	$house_slug = $_POST['house_slug'];
	$deposit_amount = 0;
	$mode_of_pay = 'CARD';
	$card_code = $_POST['card_code'];
	$query = "INSERT INTO house_deposit_tenant(user_id,house_slug,deposit_amount,mode_of_pay,pay_code,created_at) ";
	$query .= "VALUES('{$user_id}','{$house_slug}','{$deposit_amount}','{$mode_of_pay}','{$card_code}',now()) ";
	$create_query = mysqli_query($conn,$query);
	$house_det = isset($_SESSION['deposited']);
	echo var_dump($house_det);

	if (!$create_query) {
	die('QUERY FAILED' . mysqli_error($conn));
	}
	header("Location: tenants.php");

}
// cash insertion code
// card insertion deposit
if(isset($_POST['cash_btn'])) {
	global $conn;
	$user_id = $_POST['user_id'];
	$house_slug = $_POST['house_slug'];
	$deposit_amount = 0;
	$mode_of_pay = 'CASH';
	$cash_code = $_POST['cash_only'];
	$query = "INSERT INTO house_deposit_tenant(user_id,house_slug,deposit_amount,mode_of_pay,pay_code,created_at) ";
	$query .= "VALUES('{$user_id}','{$house_slug}','{$deposit_amount}','{$mode_of_pay}','{$cash_code}',now()) ";
	$create_query = mysqli_query($conn,$query);
	$house_det = isset($_SESSION['deposited']);
	echo var_dump($house_det);

	if (!$create_query) {
	die('QUERY FAILED' . mysqli_error($conn));
	}
	header("Location: tenants.php");

}
?>