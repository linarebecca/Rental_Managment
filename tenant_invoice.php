<?php  include('config.php'); ?>
<?php  include('check_session.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
	if (isset($_GET['user_id'])) {
		$tenant = getTenant($_GET['user_id']);
		
	}
    if (isset($_GET['house_slug'])) {
		$house = getHouse_Slug($_GET['house_slug']);
	}
?>
<?php include('includes/head_section.php'); ?>
<title> <?php echo $tenant ?  $tenant['user_id'] :  $_GET['user_id'] ?> | RMS</title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->
	
	<div class="content" >
		<!-- Page wrapper -->
		<div class="house-post-wrapper" style="width: 100%;">
			<!-- full post div -->
			<h1 style="text-align: center;">YOUR HOUSING DEPOSIT</h1>
			
			<button class="btn" style="margin-bottom: 30px; float: right;" onClick="window.print()">PRINT</button>
			<div class="full-house-post-div">
			<table class="table-dashboard table-striped" width="100%" id="mytable" border="2" style="background-color: grey; color: #000; margin: 0 auto;">
                    <thead>
                        <th>username</th>
                        <th>House</th>
                        <th>Deposit Amount</th>
                        <th>Date of Pay</th>
                        <th>Mode of Payment</th>
                        <th>Payment Code</th>
						<th colspan="2">Actions</th>
                    </thead>
                    <tbody>
						<?php if($tenant): ?>
                        	<td><?php echo $tenant['username']; ?></td>
                        	<td><?php echo strtoupper($tenant['house_slug']) ?> </td>
                        	<td><?php echo $tenant['deposit_amount']; ?></td>
                        	<td><?php echo $tenant['created_at']; ?></td>
                        	<td><?php echo $tenant['mode_of_pay']; ?></td>
                        	<td><?php echo $tenant['pay_code']; ?></td> 
							<td><a href="monthly_payments_invoice.php?user_id=<?php echo $tenant['user_id']?>&house_slug=<?php echo $tenant['house_slug']; ?>">monthly_invoice</a></td> 
							<td><a href="rent_payment.php?user_id=<?php echo $tenant['user_id']?>&house_slug=<?php echo $tenant['house_slug']; ?>">Renew Payment</a></td>  
						               
						<?php else: ?>
							<td colspan="7" style="text-align:center; padding:20px 0">You haven't booked for a house yet</td>
						<?php endif ?>
                    </tbody>
                </table>
			</div>
			<!-- // full post div -->
			<hr>
		</div>
		<!-- // Page wrapper -->
	</div>
</div>
<!-- // content -->

<?php include( ROOT_PATH . '/includes/footer.php'); ?>