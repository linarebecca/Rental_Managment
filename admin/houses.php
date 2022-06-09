<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/house_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

<!-- Get all landlord houses from DB -->
<?php $houses = getAllHouses(); ?>
	<title>landlord | Manage Houses</title>
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

			<?php if (empty($houses)): ?>
				<h1 style="text-align: center; margin-top: 20px;">No houses in the database.</h1>
			<?php else: ?>
				<table class="table">
						<thead>
						<th>N</th>
						<th>Creator</th>
                        <th>Title</th>
						<th>Featured Image</th>
						<!-- Only landlord can publish/unpublish houses -->
						
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
						if ($user_type == "landlord") {
						 ?>
							<th><small>Publish</small></th>
						<th><small>Add Rooms</small></th>
						<th><small>Edit</small></th>
						<th><small>Delete</small></th>
						<?php } else { ?>
						<th><small>Add Rooms</small></th>
						<th><small>Edit</small></th>
						<?php } ?>
					</thead>
					<tbody>
					<?php foreach ($houses as $key => $house): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $house['manager']; ?></td>
							<td>
								<a 	target="_blank"
								href="<?php echo BASE_URL . 'single_house.php?house-slug=' . $house['slug'] ?>">
									<?php echo $house['title']; ?>	
								</a>
							</td>
							<td><img width='100' src='../static/images/<?php echo $house['image']; ?>' alt='image' ></td>
							
							<!-- Only landlord can publish/unpublish houses -->
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
							
							if ($user_type == "landlord" ): ?>
								<td>
								<?php if ($house['published'] == true): ?>
									<a class="btn unpublish"
										href="houses.php?unpublish=<?php echo $house['id'] ?>">
										Vacant
									</a>
								<?php else: ?>
									<a class="btn publish"
										href="houses.php?publish=<?php echo $house['id'] ?>">
										Occupied
									</a>
								<?php endif ?>
								</td>
							<?php endif ?>
							<td>
								<a class="btn edit"
									href="add_house_rooms.php?rooms=<?php echo $house['slug'] ?>">
									Add Rooms
								</a>
							</td>

							<td>
								<a class="btn edit"
									href="create_house.php?edit-house=<?php echo $house['id'] ?>">
									edit
								</a>
							</td>
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
							
							if ($user_type == "landlord" ): ?>

							<td>
								<a  class="btn delete" 
									href="create_house.php?delete-house=<?php echo $house['id'] ?>">
									delete
								</a>
							</td>
							<?php endif ?>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>
