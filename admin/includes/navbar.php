<div class="header">
	<div class="logo">
		<a href="<?php echo BASE_URL .'admin/dashboard.php' ?>">
		<img src="<?php echo BASE_URL . '/static/images/logo.jpeg'; ?>" style="border-radius: 5px; float: left;" width="80px" height="60px" alt="logo-image"/>
			<h1>Rental Management System</h1>
		</a>
	</div>
	<?php 
						if (isset($_SESSION['user'])) {
							$user_role = $_SESSION['user']['id'];
							// echo var_dump($user_role);
							$query = "SELECT * FROM users WHERE id = $user_role";
							$select_user_role = mysqli_query($conn,$query);
							while($row = mysqli_fetch_assoc($select_user_role)) {
							$user_type = $row['role'];
							// $cat_title = $row['name'];
							// $_SESSION['cat_id'] = $cat_id;
							}
						}
						if ($user_type == "landlord"){
						 ?>
	<div class="user-info">
		<span>ADMININSTRATION</span> &nbsp; &nbsp; <a href="<?php echo BASE_URL . 'logout.php'; ?>" class="logout-btn">logout</a>
	</div>
	<?php } else {?>
	<div class="user-info">
		<span>MANAGEMENT</span> &nbsp; &nbsp; <a href="<?php echo BASE_URL . 'logout.php'; ?>" class="logout-btn">logout</a>
	</div>
	<?php } ?>
</div>