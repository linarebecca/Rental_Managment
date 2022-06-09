<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/tenant_functions.php'); ?>
<?php 
	// Get all landlord users from DB
	$tenants = getTenantUsers();
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
					<br>
					<a class="btn edit" style="width: 30%; float: left; margin-left: 20px;"
					href="add_tenant_user.php">
					ADD USER FOR BOOKINGS
					</a>
			    	<a class="btn edit" style="width: 30%; float: right; margin-bottom: 30px;"
					href="tenant_deposit_bookings.php">
					DEPOSIT HOUSE BOOKINGS
					</a>
					<thead>
						<th>N</th>
						<th>tenant</th>
						<th>email</th>
                        <th>house</th>
                        <th>deposit</th>
                        <th>mode of pay</th>
                        <th>pay code</th>
                        <th>date rented</th>
						<th colspan="3">Action</th>
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
							<td>
								<a class="btn edit"
									href="update_tenant_deposit.php?edit-tenant=<?php echo $tenant['id'] ?>">
									edit
								</a>
							</td>
							<td>
								<a class="btn edit"
									href="update_tenant_deposit.php?edit-tenant=<?php echo $tenant['id'] ?>">
									renew
								</a>
							</td>
							<td>
								<a class="btn delete" 
								    href="tenants.php?delete-tenant=<?php echo $tenant['id'] ?>">
									delete
								</a>
							</td>
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