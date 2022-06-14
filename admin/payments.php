<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/tenant_functions.php'); ?>
<?php 
	// Get all landlord users from DB
	$tenants = getTenantUsersPayments();
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
			<?php else: ?>
				<table class="table">
					<thead>
						<th>N</th>
						<th>tenant</th>
						<th>email</th>
                        <th>house</th>
                        <th>Amount</th>
                        <th>mode of pay</th>
                        <th>pay code</th>
                        <th>date paid</th>
					</thead>
					<tbody>
					<?php foreach ($tenants as $key => $tenant): ?>
						<tr>
							<td><?php echo $key +1; ?></td>
							<td><?php echo $tenant['username']; ?></td>
							<td><?php echo $tenant['email']; ?></td>
							<td><?php echo $tenant['title']; ?></td>
							<td><?php echo $tenant['amount']; ?></td>
                            <td><?php echo $tenant['mode_of_pay']; ?></td>
                            <td><?php echo $tenant['pay_code']; ?></td>
                            <td><?php echo $tenant['date_created']; ?></td>
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