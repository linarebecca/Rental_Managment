<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php 
	// Get all landlord users from DB
	$subcribers = getSubscribedUsersReportFilter();
	
	// $roles = ['landlord', 'manager'];				
?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>landlord | Manage subcribers</title>
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

			<?php if (empty($subcribers)): ?>
				<h1>No subcribers found in the database.</h1>
				<br>
					<a class="btn edit" style="width: 30%; float: left; margin-left: 20px;"
					href="add_subcriber_user.php">
					ADD USER FOR BOOKINGS
					</a>
			    	<a class="btn edit" style="width: 30%; float: right; margin-bottom: 30px;"
					href="subcriber_deposit_bookings.php">
					DEPOSIT HOUSE BOOKINGS
					</a>
			<?php else: ?>
	
				<table class="table">
                <h1 style="text-align: center;">SUBSCRIBED TENANTS REPORT</h1>
                    <form action="" method="post">
                        <input style="width: 40%; float:left; margin-left: 20px;" type="text" name="subcriber_email" placeholder="search by email" />
                        <input style="width: 20%; float:left; margin-top: 4px; height: 50px; margin-left: 20px;" type="submit" name="filter_subcriber" value="filter" />
                        <input onClick="window.print()" style="width: 20%; float:right; margin-top: 4px; height: 50px;" type="button" name="subcriber-name" value="PRINT" />
                    </form>
                    <?php 
                    $connection = mysqli_connect('localhost', 'root', '', 'onlinerentalsdb');
                    if (isset($_POST['filter_subcriber'])) {
                    $subcriber_email = $_POST['subcriber_email'];
                    header("Location: subcriber_filter_report.php?subcriber_report=$subcriber_email");
                    }


                    ?>
					<thead>
						<th>N</th>
						<th>subscriber name</th>
                        <th>username</th>
						<th>email</th>
                        <th>mobile</th>
                        <th>role</th>
                        <th>date joined</th>
					</thead>
					<tbody>
					<?php 
						// $page_num=ceil(count($subcribers)/$limit);
						$perpage = 15;
						
						if(isset($_GET["page"])){
						$page = intval($_GET["page"]);
					}
					else {
						$page = 1;
					}
					$calc = $perpage * $page;
					$start = $calc - $perpage;
					if (isset($_GET['subcriber_report'])) {
						$subscriber_email = $_GET['subcriber_report'];
					}
					$result = mysqli_query($conn, "SELECT * FROM users WHERE role = 'tenant' AND email LIKE '%$subscriber_email%' Limit $start, $perpage");
					$rows = mysqli_num_rows($result);
					if($rows){
						$i = 0;
						$key=1;
						while($subcriber = mysqli_fetch_assoc($result)) {
							?>
						<tr>
							<td><?php echo $key ?></td>
                            <td><?php echo $subcriber['fullname']; ?></td>
							<td><?php echo $subcriber['username']; ?></td>
							<td><?php echo $subcriber['email']; ?></td>
							<td><?php echo $subcriber['mobile']; ?></td>
							<td><?php echo $subcriber['role']; ?></td>
                            <td><?php echo $subcriber['created_at']; ?></td>
						</tr>
					<?php 
					$key++;}
					} ?>
					</tbody>
					
				</table>
				<div style="display:flex; justify-content:end; width:90%; margin:0 auto; padding-bottom:20px">
					<!-- <button style="padding:4px" >
						next
					</button> -->
					<?php
					if(isset($page))

{

$result = mysqli_query($conn,"SELECT Count(*) As Total from users");

$rows = mysqli_num_rows($result);

if($rows)

{

$rs = mysqli_fetch_assoc($result);

$total = count($subcribers);

}

$totalPages = ceil($total / $perpage);

if($page <=1 ){

echo "";

}

else

{

$j = $page - 1;

echo "<span ><a id='page_a_link' href='subcriber_filter_report.php?page=$j&&subcriber_report='>Prev</a></span>";

}

for($i=1; $i <= $totalPages; $i++)

{

if($i<>$page)

{

echo "<span><a id='page_a_link' href='subcriber_filter_report.php?page=$i&&subcriber_report='>$i</a></span>";

}

else

{

echo "<span id='active_links' style='font-weight: bold;'>$i</span>";

}

}

if($page == $totalPages )

{

echo "";

}

else

{

$j = $page + 1;

echo "<span><a id='page_a_link' href='subcriber_filter_report.php?page=$j&&subcriber_report='>Next</a></span>";

}

}

?>
				</div>
			<?php endif ?>
		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>