<?php 
/* * * * * * * * * * * * * * *
* Returns all published houses from the database
* * * * * * * * * * * * * * */
function getPublishedHouses() {
	// use global $conn object in function
	global $conn;
	$sql = "SELECT * FROM houses JOIN floors ON houses.floor_id=floors.id WHERE published=true";
	$result = mysqli_query($conn, $sql);
	// fetch all houses as an associative array called $houses
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// $final_houses = array();
	// foreach ($houses as $house) {
	// 	$house['floor'] = getHouseFloor($house['id']); 
	// 	array_push($final_houses, $house);
	// }
	return $houses;
}
/* * * * * * * * * * * * * * *
* Receives a house id and
* Returns floor of the house
* * * * * * * * * * * * * * */
// function getHouseFloor($house_id){
// 	global $conn;
// 	$sql = "SELECT * FROM floors WHERE id=
// 			(SELECT floor_id FROM house_floors WHERE house_id=$house_id) LIMIT 1";
// 	$result = mysqli_query($conn, $sql);
// 	$floor = mysqli_fetch_assoc($result);
// 	return $floor;
// }
/* * * * * * * * * * * * * * * *
* Returns all houses under a floor
* * * * * * * * * * * * * * * * */
function getPublishedHousesByFloor($floor_id) {
	global $conn;
	$sql = "SELECT * FROM houses WHERE floor_id = $floor_id HAVING COUNT(1) = 1";
	$result = mysqli_query($conn, $sql);
	// fetch all houses as an associative array called $houses
	$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// $final_houses = array();
	// foreach ($houses as $house) {
	// 	$house['floor'] = getHouseFloor($house['id']); 
	// 	array_push($final_houses, $house);
	// }
	return $houses;
}
/* * * * * * * * * * * * * * * *
* Returns floor name by floor id
* * * * * * * * * * * * * * * * */
function getFloorNameById($id)
{
	global $conn;
	$sql = "SELECT name FROM floors WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	$floor = mysqli_fetch_assoc($result);
	return $floor['name'];
}
/* * * * * * * * * * * * * * *
* Returns a single house
* * * * * * * * * * * * * * */
function getHouse($id){
	global $conn;
	// Get single house slug
	$house_id = $_GET['house-id'];
	$sql = "SELECT * FROM houses WHERE id='$house_id' AND published=true";
	$result = mysqli_query($conn, $sql);

	// fetch query results as associative array.
	$house = mysqli_fetch_assoc($result);
	return $house;
}

/* * * * * * * * * * * * * * *
* Returns a single house for bookings
* * * * * * * * * * * * * * */
function getHouseForBookings($id){
	global $conn;
	// Get single house slug
	$deposit_house_id = $_GET['deposit'];
	$sql = "SELECT * FROM houses WHERE id='$deposit_house_id' AND published=true";
	$result = mysqli_query($conn, $sql);

	// fetch query results as associative array.
	$house = mysqli_fetch_assoc($result);
	return $house;
}

function getHouseImages($id){
	global $conn;
	// Get single house interior images
	$house_id = $_GET['house-id'];
	$sql = "SELECT * FROM house_images WHERE house_id='$house_id'";
	$result = mysqli_query($conn, $sql);

	// fetch query results as associative array.
	$house_images = mysqli_fetch_assoc($result);
	return $house_images;
}
/* * * * * * * * * * * *
*  Returns all floors
* * * * * * * * * * * * */
function getAllFloors()
{
	global $conn;
	$sql = "SELECT * FROM floors";
	$result = mysqli_query($conn, $sql);
	$floors = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $floors;
}
// get tenant information
function getTenant($id){
	global $conn;
	// Get single house slug
	$tenant_id = $_GET['user_id'];
	$sql = "SELECT * FROM house_deposit_tenant JOIN users ON house_deposit_tenant.user_id=users.id WHERE user_id='$tenant_id'";
	// $sql = "SELECT * FROM house_deposit_tenant JOIN users ON house_deposit_tenant.user_id=users.id JOIN houses ON house_deposit_tenant.house_id=houses.id WHERE user_id='$house_id'";
	$result = mysqli_query($conn, $sql);

	// fetch query results as associative array.
	$tenant = mysqli_fetch_assoc($result);
	return $tenant;
}
// get HOUSE information
function getHouse_ID($id){
	global $conn;
	// Get single house slug
	$house_id = $_GET['house_id'];
	$sql = "SELECT * FROM houses WHERE user_id='$house_id'";
	// $sql = "SELECT * FROM house_deposit_tenant JOIN users ON house_deposit_tenant.user_id=users.id JOIN houses ON house_deposit_tenant.house_id=houses.id WHERE user_id='$house_id'";
	$result = mysqli_query($conn, $sql);

	// fetch query results as associative array.
	$house_name = mysqli_fetch_assoc($result);
	return $house_name;
}



?>