<?php  include('config.php'); ?>
<!-- Source code for handling registration and login -->
<?php  include('includes/registration_login.php'); ?>

<?php include('includes/head_section.php'); ?>

<title>RMS | Sign up </title>
</head>
<body>
<div class="container register-user">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="register.php" class="form-register">
			<h2>Register AS Tenant Only Form</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input  type="text" name="fullname" value=""  placeholder="Fullname">
			<input  type="hidden" name="role" value="tenant"  placeholder="role">
			<input  type="text" name="username" value="<?php echo $username; ?>"  placeholder="Username">
			<input  type="text" name="mobile" value=""  placeholder="Mobile">
			<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
			<input type="password" name="password_1" placeholder="Password">
			<input type="password" name="password_2" placeholder="Password confirmation">
			<button type="submit" class="btn" name="reg_user">Register</button>
			<p>
				Already a member? <a href="login.php">Sign in</a>
			</p>
		</form>
	</div>
</div>
<!-- // container -->
<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->