<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>landlord | dashboard</title>
</head>
<body>
	<!-- landlord navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
	<div class="container content dashboard">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>
		<div class="action create-post-div">
			<h1 class="page-title">Welcome To Admin Dashboard</h1>
			<table class="table" style="width: 100%; margin-left: 30px; background-color:aliceblue;">
						<thead>
						<th>TENANTS</th>
						<th>HOUSES</th>
                        <th>PAYMENTS</th>
						<th>SUBSCRIBERS</th>
						</thead>
					<tbody>
						<td>
						<?php
		$db = mysqli_connect('localhost','root','','onlinerentalsdb');
            $query = "SELECT * FROM house_deposit_tenant";
             $select_all_tenants = mysqli_query($db,$query);
             if ($result=$select_all_tenants) {
                 $rowcount=mysqli_num_rows($result);
                //  echo "The total number of rows are: ".$rowcount; 
            ?>
            <h1>TOTAL:<?php echo $rowcount; ?> </h1>
            <?php  } ?>
            <a href="tenants.php">view</a>
       </td>
						<td>
						<?php
		$db = mysqli_connect('localhost','root','','onlinerentalsdb');
            $query = "SELECT * FROM houses";
             $select_all_tenants = mysqli_query($db,$query);
             if ($result=$select_all_tenants) {
                 $rowcount=mysqli_num_rows($result);
                //  echo "The total number of rows are: ".$rowcount; 
            ?>
            <h1>TOTAL:<?php echo $rowcount; ?> </h1>
            <?php  } ?>
            <a href="houses.php">view</a>
						</td>
						<td>
						<?php
		$db = mysqli_connect('localhost','root','','onlinerentalsdb');
            $query = "SELECT * FROM monthly_payments";
             $select_all_tenants = mysqli_query($db,$query);
             if ($result=$select_all_tenants) {
                 $rowcount=mysqli_num_rows($result);
                //  echo "The total number of rows are: ".$rowcount; 
            ?>
            <h1>TOTAL:<?php echo $rowcount; ?> </h1>
            <?php  } ?>
            <a href="payments.php">view</a>
						</td>
						<td>
						<?php
		$db = mysqli_connect('localhost','root','','onlinerentalsdb');
            $query = "SELECT * FROM users WHERE role='tenant'";
             $select_all_tenants = mysqli_query($db,$query);
             if ($result=$select_all_tenants) {
                 $rowcount=mysqli_num_rows($result);
                //  echo "The total number of rows are: ".$rowcount; 
            ?>
            <h1>TOTAL:<?php echo $rowcount; ?> </h1>
            <?php  } ?>
            <a href="users.php">view</a>
						</td>
					</tbody>
				</table>
		</div>
		<!-- // Middle form - to create and edit -->
	</div>
</body>
</html>

<script>
	// CKEDITOR.replace('body');
</script>
		
	</div>
</body>
</html>