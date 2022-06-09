<div class="navbar">
	<div class="logo_div">
		<a href="index.php" class="logo-image">
			<img src="<?php echo BASE_URL . '/static/images/logo.jpeg'; ?>" style="border-radius: 5px; float: left;" width="80px" height="60px" alt="logo-image"/>
       <h1>RENTAL MANAGEMENT SYSTEM</h1></a>
	</div>
	<ul>
	  <li><a href="index.php">Home</a></li>
	  <!-- show logged in user using already defined session login and regiter function -->
	  <?php if (isset($_SESSION['user']['username'])) { ?>
	  <li style="background-color: #000;"><a href="#"><?php echo $_SESSION['user']['username'] ?></a></li>
	  <?php
	  global $conn;
	  // Get single house slug
	  $tenant_id = $_SESSION['user']['id'];
	  $sql = "SELECT * FROM house_deposit_tenant JOIN users ON house_deposit_tenant.user_id=users.id WHERE user_id='$tenant_id'";
	  // $sql = "SELECT * FROM house_deposit_tenant JOIN users ON house_deposit_tenant.user_id=users.id JOIN houses ON house_deposit_tenant.house_id=houses.id WHERE user_id='$house_id'";
	  $result = mysqli_query($conn, $sql);
	  while ($row = mysqli_fetch_assoc($result)) {
		$house_slug = $row['house_slug'];
		// $username = $row['username'];
	  }
	  ?>
	  <li style="background-color: #000;"><a href="tenant_invoice.php?user_id=<?php echo $_SESSION['user']['id'] ?>?>&house_slug=<?php echo $house_slug; ?>">Account</a></li>
	  <li style="background-color: #000;"><a style="color: red;" href="logout.php">Logout</a></li>
	  <?php }else{ ?>
	  <li><a href="<?php echo BASE_URL . 'login.php'; ?>">Login</a></li>
	  <li><a href="<?php echo BASE_URL . 'register.php'; ?>">Register</a></li>
	  <?php } ?>
	</ul>
</div>
