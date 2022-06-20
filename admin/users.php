<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php 
	// Get all landlord users from DB
	$landlords = getlandlordUsers();
	$users=array();
	foreach ($landlords as $i => $landlord) {
		if ($landlord['role']==='tenant') {
			array_push($users, $landlord);
		}

	}

	$roles = ['landlord', 'manager'];				
?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>landlord | Manage users</title>
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
                    	header("Location: users.php?user_search=$user");
                    }


                    ?>
		<!-- Middle form - to create and edit  -->
		<div class="action">
			<h1 class="page-title">ADD & UPDATE ADMIN USER</h1>

			<form method="post" action="<?php echo BASE_URL . 'admin/users.php'; ?>" >

				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>

				<!-- if editing user, the id is required to identify that user -->
				<?php if ($isEditingUser === true): ?>
					<input type="hidden" name="landlord_id" value="<?php echo $landlord_id; ?>">
				<?php endif ?>

				<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
				<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
				<input type="password" name="password" placeholder="Password">
				<input type="password" name="passwordConfirmation" placeholder="Password confirmation">
				<select name="role">
					<option value="" selected disabled>Assign role</option>
					<?php foreach ($roles as $key => $role): ?>
						<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
					<?php endforeach ?>
				</select>

				<!-- if editing user, display the update button instead of create button -->
				<?php if ($isEditingUser === true): ?> 
					<button type="submit" class="btn" name="update_landlord">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_landlord">Save User</button>
				<?php endif ?>
			</form>
		</div>
		<!-- // Middle form - to create and edit -->

		<!-- Display records from DB-->
		<div class="table-div">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/admin/includes/messages.php') ?>

			<?php if (empty($users)): ?>
				<h1>No landlords in the database.</h1>
			<?php else: ?>
				<form action="" method="post" style='padding-bottom:0; margin-bottom:0; width:100%; padding-top:20px; padding-left:20px'>
                        <input style="width: 350px; float: left;" type="text" name="user" placeholder="search by name" />
                        <input style="margin-left: 30px; padding: 15px;" type="submit" name="filter_user" value="filter" />
						<input onClick="window.print()" style="margin-left: 30px; padding: 15px;" type="button" name="" value="PRINT" />
                    </form>
				<table class="table">
					<thead>
						<th>N</th>
						<th>landlord</th>
						<th>Role</th>
						<th colspan="2">Action</th>
					</thead>
					<tbody>
					<?php foreach ($users as $key => $landlord): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td>
								<?php echo $landlord['username']; ?>, &nbsp;
								<?php echo $landlord['email']; ?>	
							</td>
							<td><?php echo $landlord['role']; ?></td>
							<td>
								<a class="btn edit"
									href="users.php?edit-landlord=<?php echo $landlord['id'] ?>">
									edit
								</a>
							</td>
							<td>
								<a class="btn delete" 
								    href="users.php?delete-landlord=<?php echo $landlord['id'] ?>">
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