<?php  include('../config.php'); ?>
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
		<div class="table-div"  style="width: 80%;">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/admin/includes/messages.php') ?>
				<table class="table">
						<thead>
						<th>N</th>
						<th>House</th>
                        <th>Room</th>
						<!-- <th>Floor</th> -->
                        <th>Price</th>
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
                            $query = "SELECT * FROM house_images JOIN houses ON house_images.house_slug=houses.slug;";
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
                            echo "<td>{$house_price}</td>";
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
                                header("Location: rooms.php");
                                }
                            ?>
					</tbody>
				</table>
		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>
