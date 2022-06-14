<?php  include('config.php'); ?>
<?php  include('includes/head_section.php'); ?>
<?php  include('includes/registration_login.php'); ?>
	<title>RMS | Forgot Password  </title>
</head>
<body>

<body>
<div class="container register-user">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="forgot_password.php" class="form-reset">
			<h2>Forgot  Password </h2>
            <div class="form-group">
                <input type="email" name="email" class="control" placeholder="email" required="true">
            </div>        
			<button type="submit" class="btn" name="newpassword" onsubmit="return false">Forgot Password</button>
            

		</form>
	</div>
</div>
<!-- // container -->
<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->