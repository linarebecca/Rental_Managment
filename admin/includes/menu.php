<div class="sidebar-menu">
	<div class="sidebar-card">
		<div class="sidebar-card-header">
			<h2>Navigate</h2>
		</div>
		<div class="sidebar-card-content">
		    <a href="<?php echo BASE_URL . 'admin/dashboard.php' ?>">Dashboard</a>
			<a href="<?php echo BASE_URL . 'admin/create_house.php' ?>">Add house</a>
			<a href="<?php echo BASE_URL . 'admin/houses.php' ?>">Manage houses</a>
			<a href="<?php echo BASE_URL . 'admin/rooms.php' ?>">Manage rooms</a>
			<?php
						if (isset($_SESSION['user'])) {
							$user_role = $_SESSION['user']['id'];
							$query = "SELECT * FROM users WHERE id = $user_role ";
							$select_user_role = mysqli_query($conn,$query);
							while($row = mysqli_fetch_assoc($select_user_role)) {
							$user_type = $row['role'];
							}
						}
						if ($user_type == "landlord") {
						?>
			<a href="<?php echo BASE_URL . 'admin/users.php' ?>">Manage Users</a>
			<?php } ?>
			<a href="<?php echo BASE_URL . 'admin/floors.php' ?>">Manage Floors</a>
			<a href="<?php echo BASE_URL . 'admin/tenants.php' ?>">Tenants</a>
			<a href="<?php echo BASE_URL . 'admin/payments.php' ?>">Payments</a>
			<a href="<?php echo BASE_URL . 'admin/reports.php' ?>">Reports</a>
		</div>
	</div>
</div>
