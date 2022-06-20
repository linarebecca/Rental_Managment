<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
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
		<div class="table-div"  style="width: 80%; padding-top:20px">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/admin/includes/messages.php') ?>
			<table class="table">
                
                    <form action="" method="post">
                        <input style="width: 40%; float:left; margin-left: 20px;" type="text" name="house_title" placeholder="search by house title" />
                        <input style="width: 20%; float:left; margin-top: 4px; height: 50px; margin-left: 20px;" type="submit" name="filter_house" value="filter" />
                        <input onClick="window.print()" style="width: 20%; float:right; margin-top: 4px; height: 50px;" type="button" value="PRINT" />
                    </form>
					<?php 
                    if (isset($_POST['filter_house'])) {
                    	$house_title = $_POST['house_title'];
                    	header("Location: houses.php?house_search=$house_title");
                    }
			 ?>
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
						<th><small>Add House Images</small></th>
						<th><small>Edit</small></th>
						<th><small>Delete</small></th>
						<?php } else { ?>
						<th><small>Add House Images</small></th>
						<th><small>Edit</small></th>
						<?php } ?>
					</thead>
					<tbody>
					<?php 
						$db = mysqli_connect("localhost", "root", "", "onlinerentalsdb");
						$perpage = 5;
						
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
					?>
					<?php foreach ($houses as $key => $house): 
						if($house_no==''):
						?>
						
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
									Upload
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
						<?php endif ?>
						<?php if($house_no!=='' && strtolower($house_no)==strtolower($house['title'])):?>
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
									Upload
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
						
						<?php endif ?>
					<?php endforeach ?>
					</tbody>
				</table>
			
		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>
