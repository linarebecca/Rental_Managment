<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/tenant_functions.php'); ?>
<?php 
	// Get all landlord users from DB
	$tenants = getTenantUsersFilterReport();
	// $roles = ['landlord', 'manager'];				
?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>landlord | Manage tenants</title>
</head>
<body>
	<!-- landlord navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>
		<!-- Middle form - to create and edit  -->
		

		<!-- Display records from DB-->
		<div class="table-div" style="width: 80%;">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/admin/includes/messages.php') ?>

			<?php if (empty($tenants)): ?>
				<h1>No tenants found in the database.</h1>
				<br>
					<a class="btn edit" style="width: 30%; float: left; margin-left: 20px;"
					href="add_tenant_user.php">
					ADD USER FOR BOOKINGS
					</a>
			    	<a class="btn edit" style="width: 30%; float: right; margin-bottom: 30px;"
					href="tenant_deposit_bookings.php">
					DEPOSIT HOUSE BOOKINGS
					</a>
			<?php else: ?>
	
				<table class="table">
                <h1 style="text-align: center;">TENANTS REPORT</h1>
                    <form action="" method="post">
                        <input style="width: 40%; float:left; margin-left: 20px;" type="text" name="tenant_email" placeholder="search by email" />
                        <input style="width: 20%; float:left; margin-top: 4px; height: 50px; margin-left: 20px;" type="submit" name="filter_tenant" value="filter" />
                        <input onClick="window.print()" style="width: 20%; float:right; margin-top: 4px; height: 50px;" type="button" name="tenant-name" value="PRINT" />
                    </form>
                    <?php 
                    $connection = mysqli_connect('localhost', "lina", "linaRebeca1", 'onlinerentalsdb');
                    if (isset($_POST['filter_tenant'])) {
                    $tenant_email = $_POST['tenant_email'];
                    header("Location: tenant_filter_report.php?tenant_report=$tenant_email");
                    }


                    ?>
					<thead>
						<th>N</th>
						<th>tenant</th>
						<th>email</th>
                        <th>house</th>
                        <th>deposit</th>
                        <th>mode of pay</th>
                        <th>pay code</th>
                        <th>date rented</th>
					</thead>
					<tbody>
					<?php foreach ($tenants as $key => $tenant): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $tenant['username']; ?></td>
							<td><?php echo $tenant['email']; ?></td>
							<td><?php echo $tenant['title']; ?></td>
							<td><?php echo $tenant['deposit_amount']; ?></td>
                            <td><?php echo $tenant['mode_of_pay']; ?></td>
                            <td><?php echo $tenant['pay_code']; ?></td>
                            <td><?php echo $tenant['created_at']; ?></td>
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