<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/house_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>landlord | Manage Rooms</title>
</head>
<body>
	<!-- landlord navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- Display records from DB-->
		<div class="table-div"  style="width: 80%; padding-top:20px">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/admin/includes/messages.php') ?>
				<table class="table"  >
				<form action="" method="post">
                        <input style="width: 40%; float:left; margin-left: 20px;" type="text" name="house_no" placeholder="search by house number" />
                        <input style="width: 20%; float:left; margin-top: 4px; height: 50px; margin-left: 20px;" type="submit" name="filter_house" value="filter" />
                    </form>
					<?php 
                    if (isset($_POST['filter_house'])) {
                    	$house_no = $_POST['house_no'];
                    	header("Location: rooms.php?house_search=$house_no");
                    }


                    ?>
						<thead>
						<th>N</th>
						<th>House</th>
                        <th>Room</th>
						<!-- <th>Floor</th> -->
                       
						<th><small>Image</small></th>
						<th><small>Edit</small></th>
                        <?php 
						if (isset($_SESSION['user'])) {
							$user_role = $_SESSION['user']['id'];
							$query = "SELECT * FROM users WHERE id = $user_role ";
							$select_user_role = mysqli_query($conn,$query);
							while($row = mysqli_fetch_assoc($select_user_role)) {
							$user_type = $row['role'];
							// $cat_title = $row['name'];
							// $_SESSION['cat_id'] = $cat_id;
							}
						}
						if ($user_type == "landlord"):
						 ?>
						<th><small>Delete</small></th>
                        <?php endif; ?>
					</thead>
					<tbody>
                    <?php
                                    // Create database connection
                            $db = mysqli_connect("localhost", "root", "", "onlinerentalsdb");
							$perpage = 15;
							
							if(isset($_GET["page"])){
								$page = intval($_GET["page"]);
							}
							else {
								$page = 1;
							}
							$calc = $perpage * $page;
							$start = $calc - $perpage;
							if (isset($_GET['house_search'])) {
								$house_no = $_GET['house_search'];
							}else{
								$house_no='';
							}
                            $query = "SELECT * FROM house_images JOIN houses ON house_images.house_slug=houses.slug AND house_slug LIKE '%$house_no%' Limit $start, $perpage";
                            $select_all_rooms = mysqli_query($db,$query);
                            $i = 0;
                            while($row = mysqli_fetch_assoc($select_all_rooms)) {
                            $room_id = $row['room_id'];
                            $house_slug = $row['house_slug'];
                            $title = $row['title'];
                            $body = $row['description'];
                            $house_price = $row['price'];
                            $room_image = $row['room_image'];
                            $i++;
                            echo "<tr>";
                            echo "<td>{$i}</td>";
                            echo "<td>{$title}</td>";
                            echo "<td>{$body}</td>";
                            // echo "<td>{$house_price}</td>";
                            echo "<td><img width='100' src='../static/images/{$room_image}' alt'image' ></td>";
                            echo "<td><a class='btn edit' href='update_rooms.php?edit={$room_id}'>Edit</a></td>";
                        // CHECK USER PRIVILEDGES
						if (isset($_SESSION['user'])) {
							$user_role = $_SESSION['user']['id'];
							$query = "SELECT * FROM users WHERE id = $user_role ";
							$select_user_role = mysqli_query($conn,$query);
							while($row = mysqli_fetch_assoc($select_user_role)) {
							$user_type = $row['role'];
							// $cat_title = $row['name'];
							// $_SESSION['cat_id'] = $cat_id;
							}
						}
						if ($user_type == "landlord"):
                         echo "<td><a class='btn delete' href='rooms.php?delete={$room_id}'>Delete</a></td>";
                        endif;
                            echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                            if (isset($_GET['delete'])) {
                                $the_room_id = $_GET['delete'];
                                $query = "DELETE FROM house_images WHERE room_id = {$the_room_id} ";
                                $delete_query = mysqli_query($db,$query);
                                // header("Location: rooms.php");
								echo "<script>
								
									window.reload()
								</script>";
                                }
                            ?>
							<?php if (mysqli_num_rows($select_all_rooms)<1): ?>
								<tr>
									<h1 style='text-align:center'>No houses found in the database.</h1>
								</tr>
							<?php endif ?>
					</tbody>
				</table>
				<div style="display:flex; justify-content:end; width:90%; margin:0 auto; padding-bottom:20px">
					<!-- <button style="padding:4px" >
						next
					</button> -->
					<?php
					if(isset($page))

{

$result = mysqli_query($conn,"SELECT Count(*) As Total from house_images");

$rows = mysqli_num_rows($result);

if($rows)

{

$rs = mysqli_fetch_assoc($result);

$total = $rs['Total'];

}

$totalPages = ceil($total / $perpage);

if($page <=1 ){

echo "";

}

else

{

$j = $page - 1;

echo "<span ><a id='page_a_link' href='rooms.php?page=$j&&house_no'>Prev</a></span>";

}

for($i=1; $i <= $totalPages; $i++)

{

if($i<>$page)

{

echo "<span><a id='page_a_link' href='rooms.php?page=$i&&house_no='>$i</a></span>";

}

else

{

echo "<span id='active_links' style='font-weight: bold;'>$i</span>";

}

}

if($page == $totalPages )

{

echo "";

}

else

{

$j = $page + 1;

echo "<span><a id='page_a_link' href='rooms.php?page=$j&&house_no='>Next</a></span>";

}

}

?>
				</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>
