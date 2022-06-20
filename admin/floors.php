<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<!-- Get all floors from DB -->
<?php $floors = getAllFloors();	?>
	<title>landlord | Manage Floors</title>
</head>
<body>
	<!-- landlord navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>
		
					<?php 
                    if (isset($_POST['filter_user'])) {
                    	$user = $_POST['user'];
                    	header("Location: floors.php?user_search=$user");
                    }


                    ?>

		<!-- Middle form - to create and edit -->
		<div class="action">
			<h1 class="page-title">ADD & UPDATE FLOORS</h1>
			<form method="post" action="<?php echo BASE_URL . 'admin/floors.php'; ?>" >
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
				<!-- if editing floor, the id is required to identify that floor -->
				<?php if ($isEditingFloor === true): ?>
					<input type="hidden" name="floor_id" value="<?php echo $floor_id; ?>">
				<?php endif ?>
				<input type="text" name="floor_name" value="<?php echo $floor_name; ?>" placeholder="Floor">
				<!-- if editing floor, display the update button instead of create button -->
				<?php if ($isEditingFloor === true): ?> 
					<button type="submit" class="btn" name="update_floor">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_floor">Save Floor</button>
				<?php endif ?>
			</form>
		</div>
		<!-- // Middle form - to create and edit -->

		<!-- Display records from DB-->
		<div class="table-div">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/admin/includes/messages.php') ?>
			<?php if (empty($floors)): ?>
				<h1>No floors in the database.</h1>
			<?php else: ?>
				<form action="" method="post" style='padding-bottom:0; margin-bottom:0; width:100%; padding-top:20px; padding-left:20px'>
                        <input style="width: 350px; float: left;" type="text" name="user" placeholder="search by name" />
                        <input style="margin-left: 30px; padding: 15px;" type="submit" name="filter_user" value="filter" />
						<input onClick="window.print()" style="margin-left: 30px; padding: 15px;" type="button" name="" value="PRINT" />
                    </form>
				<table class="table">
					<thead>
						<th>N</th>
						<th>Floor Name</th>
						<th colspan="2">Action</th>
					</thead>
					<tbody>
					<?php foreach ($floors as $key => $floor): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $floor['name']; ?></td>
							<td>
								<a class="btn edit"
									href="floors.php?edit-floor=<?php echo $floor['id'] ?>">
									edit
								</a>
							</td>
							<td>
								<a class="btn delete"								
									href="floors.php?delete-floor=<?php echo $floor['id'] ?>">
									delete
								</a>
							</td>
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