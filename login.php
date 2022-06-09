<?php  include('config.php'); ?>
<?php  include('includes/registration_login.php'); ?>
<?php  include('includes/head_section.php'); ?>
	<title>RMS | Sign in </title>
</head>
<body>
<div class="container register-user">
	<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="login.php" class="form-login">
			<h2>Login</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<div class="drop-select" >
			<select name="user_type" id="selectValidate">
						<option>...Select User...</option>
						<option value="tenant">tenant</option>
						<option value="landlord">admin</option>
						<option value="manager">manager</option>
			</select>
			</div>
			<input type="text" name="username" value="<?php echo $username; ?>" value="" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" class="btn" name="login_btn">Login</button>
			<p>
				Not yet a member? <a href="register.php">Sign up</a>
			</p>

			<p>
				forgot password? <a href= 'Forgot_password.php'> Forgot password </a>
			</p>
		</form>
	</div>
</div>
<!-- // container -->

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->