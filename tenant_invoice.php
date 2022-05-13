<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
	if (isset($_GET['user_id'])) {
		$tenant = getTenant($_GET['user_id']);
	}
    if (isset($_GET['house_id'])) {
		$house = getHouse_ID($_GET['house_id']);
	}
?>
<?php include('includes/head_section.php'); ?>
<title> <?php echo $tenant['user_id'] ?> | RMS</title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->
	
	<div class="content" >
		<!-- Page wrapper -->
		<div class="post-wrapper">
			<!-- full post div -->
			<div class="full-post-div">
                <table>
                    <thead>
                        <th>username</th>
                        <th>House</th>
                        <th>Deposit Amount</th>
                        <th>Date of Pay</th>
                        <th>Mode of Payment</th>
                        <th>Payment Code</th>
                    </thead>
                    <tbody>
                        <td><?php echo $tenant['username']; ?></td>
                        <td><?php echo $house['title'] ?> </td>
                        <td><?php echo $tenant['deposit_amount']; ?></td>
                        <td><?php echo $tenant['created_at']; ?></td>
                        <td><?php echo $tenant['mode_of_pay']; ?></td>
                        <td><?php echo $tenant['pay_code']; ?></td>                  
                    </tbody>
                </table>
			</div>
			<!-- // full post div -->
			<hr>
		</div>
		<!-- // Page wrapper -->

		<!-- post sidebar -->
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>ACTIONS</h2>
				</div>
				<div class="card-content">
						<a 
							href="tenant_invoic?user_id=<?php $tenant['user_id']; ?> .'&'. 'house=<?php $house['house_id']; ?>">DEPOSIT INVOICE
						</a> 
                        <a 
							href="<?php echo BASE_URL . 'monthly_invoice.php?monthly=' . isset($_GET['user_id']).'&'.'house='.isset($_GET['house_id']); ?>">MONTHLY INVOICE
						</a> 
						<a 
							href="<?php echo BASE_URL . 'rent_payment.php?monthly=' . isset($_GET['user_id']).'&'.'house='.isset($_GET['house_id']); ?>">RENT PAYMENT
						</a> 				
				</div>
			</div>
		</div>
		<!-- // post sidebar -->
	</div>
</div>
<!-- // content -->

<?php include( ROOT_PATH . '/includes/footer.php'); ?>