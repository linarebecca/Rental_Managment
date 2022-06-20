<?php  include('config.php'); ?>
<?php  include('check_session.php'); ?>
<?php  include('includes/head_section.php'); ?>
<?php  include('includes/registration_login.php');
$email=$_GET['email']

?>
	<title>RMS | Reset Password  </title>
</head>
<body>

<body>
<div class="container register-user">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); 
        ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin:80px auto;">
		<form method="post" action="<?php echo 'reset_password.php?email='.$email; ?>" class="form-reset">
			<h2>New  Password </h2>
            <?php include(ROOT_PATH . '/includes/errors.php') ?>
            <div class="form-group">
                <input type="password" name="newpwd" class="control" placeholder="Password" style='background-color:#f5f5f5 !important; margin-top: 40px !important'>
                <input type="password" name="confirmpwd" class="control" placeholder="Confirm Password" style='background-color:#f5f5f5 !important; margin-top: 20px !important'>
            </div>        
			<button type="submit" class="btn" name="setpassword" onsubmit="return false" style='margin-top: 20px; width:100%'>Save Password</button>
            

		</form>
	</div>
    </div>
<!-- // container -->
<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->