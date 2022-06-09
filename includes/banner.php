<!-- i want to check if user is in session -->
<?php if (isset($_SESSION['user']['username'])) { ?>
	<div class="logged_in_info">
		<span>welcome <?php echo $_SESSION['user']['username'] ?></span>
		|
		<span><a href="logout.php">logout</a></span>
	</div>
<?php }else{ ?>
	<div class="banner">
		<div class="welcome_msg">
			<h1>RENT A HOME TODAY</h1>
			<p> 
			    A Happy Family Needs A Better Home <br> 
			</p>
			<a href="register.php" class="btn">REGISTER</a>
		</div>

		<div class="login_div">
			<form action="<?php echo BASE_URL . 'index.php'; ?>" method="post" >
				<h2>Login</h2>
				<div style="width: 60%; margin: 0px auto;">
					<?php include(ROOT_PATH . '/includes/errors.php') ?>
				</div>
				<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
				<input type="password" name="password"  placeholder="Password"> 
				<div class="drop-select" >
				<select name="user_type" id="selectValidate">
                            <option>...Select User...</option>
                            <option value="tenant">tenant</option>
                            <option value="landlord">admin</option>
                            <option value="manager">manager</option>
                </select>
				</div>
				<button class="btn" type="submit" name="login_btn">Sign in</button>
			</form>
		</div>
	</div>
<?php } ?>