<?php  include('config.php'); ?>
<?php  include('check_session.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
	if (isset($_GET['user_id'])) {
        $tenant_id = $_GET['user_id'];
	}
    if (isset($_GET['house_slug'])) {
		$house_slug = $_GET['house_slug'];
		$houses = getHouse_Slug($house_slug);
	}
?>
<?php include('includes/head_section.php'); ?>
<title> <?php echo $tenant_id ?> | RMS</title>
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
			<h1 style="text-align: center;">YOUR MONTHLY INVOICE</h1>
			<a href="tenant_invoice.php?user_id=<?php echo $tenant_id ;?>&house_slug=<?php echo $house_slug; ?>" style="margin-bottom: 30px; margin-right: 20px; float: right;"><button class="btn">BACK</button></a>
			<button class="btn" style="margin-bottom: 30px; margin-right: 20px; float: right;" onClick="window.print()">PRINT</button>
			<div class="full-house-post-div">
			<table class="table-dashboard table-striped" width="100%" id="mytable" border="2" style="background-color: grey; color: #000; margin: 0 auto;">
                    <thead>
					<th>#</th>
                        <th>username</th>
                        <th>House</th>
                        <th>Amount</th>
                        <th>Date of Pay</th>
                        <th>Mode of Payment</th>
                        <th>Payment Code</th>
                        <th colspan="2">Actions</th>
                    </thead>
                    <tbody>
					<?php  
					$sql = "SELECT * FROM monthly_payments JOIN users ON monthly_payments.user_id=users.id WHERE user_id='$tenant_id'";
                    // $sql1 = "SELECT * FROM houses WHERE slug LIKE '%$house_slug%'";
					$results = mysqli_query($conn,$sql);
                    $i=0;
                    while ($row = mysqli_fetch_assoc($results)) {
                        $i++;
						$user_id = $row['user_id'];
                        $username = $row['username'];
						// $house_title = $row['title'];
                        $amount = $row['amount'];
                        $created_at = $row['date_created'];
                        $mode_of_pay = $row['mode_of_pay'];
                        $pay_code = $row['pay_code'];
                       
                        echo "<tr>";
                        echo "<td>{$i}</td>";
                        echo "<td>{$username}</td>";
                        echo "<td>{$houses['title']}</td>";
                        echo "<td>{$amount}</td>";
                        echo "<td>{$created_at}</td>";
                        echo "<td>{$mode_of_pay}</td>";
                        echo "<td>{$pay_code}</td>";
						echo "<td><a class='edit' href='tenant_invoice.php?user_id={$user_id}&house_slug={$houses['slug']}'>DEPOSIT STATUS</a></td>";
                        echo "<td><a class='delete' href='rent_payment.php?user_id={$user_id}&house_slug={$houses['slug']}'>RENEW HOUSE</a></td>";
                        echo "</tr>";
                    }
                    ?>       
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