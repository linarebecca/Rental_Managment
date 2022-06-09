<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '../includes/registration_login.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>landlord | Create New Tenant User</title>
</head>
<body>
	<!-- landlord navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- Middle form - to create and edit  -->
		<div class="action create-post-div">
			<h1 class="page-title">Add Tenant User</h1>
			<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'admin/add_tenant_user.php'; ?>" >
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>

				<!-- if editing house, the id is required to identify that house -->
				<input type="hidden" name="role" value="tenant">
			
				<input type="text" name="fullname" value="" placeholder="Fullname">
				<input type="text" name="username" value="" placeholder="Username">
				<input type="text" name="mobile" value="" placeholder="Mobile">
				<input type="text" name="email" value="" placeholder="Email">
				<input type="text" name="password_1" value="" placeholder="Password">
				<input type="text" name="password_2" value="" placeholder="Confirm Password">
			
					<button type="submit" class="btn" name="reg_user_by_admin">Save User</button>

			</form>
		</div>
		<!-- // Middle form - to create and edit -->
	</div>
</body>
</html>
