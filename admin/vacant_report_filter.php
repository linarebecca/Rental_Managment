<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/house_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

<!-- Get all landlord houses from DB -->
<?php $houses = getAllHousesReportVacantFilter(); ?>
	<title>landlord | Manage Houses</title>
</head>
<body>
	<!-- landlord navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- Display records from DB-->
		<div class="table-div"  style="width: 80%;">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/admin/includes/messages.php') ?>

			<?php if (empty($houses)): ?>
				<h1 style="text-align: center; margin-top: 20px;">No houses in the database.</h1>
			<?php else: ?>
				<table class="table">
                <h1 style="text-align: center;">VACANT HOUSE REPORT</h1>
                    <form action="" method="post">
                        <input style="width: 40%; float:left; margin-left: 20px;" type="text" name="house_label" placeholder="search by house label" />
                        <input style="width: 20%; float:left; margin-top: 4px; height: 50px; margin-left: 20px;" type="submit" name="filter_houses" value="filter" />
                        <input onClick="window.print()" style="width: 20%; float:right; margin-top: 4px; height: 50px;" type="button" value="PRINT" />
                    </form>
                    <?php 
                    $connection = mysqli_connect('localhost', "lina", "linaRebeca1", 'onlinerentalsdb');
                    if (isset($_POST['filter_houses'])) {
                    $house_label = $_POST['house_label'];
                    header("Location: vacant_report_filter.php?house_label=$house_label");
                    }


                    ?>
						<thead>
						<th>N</th>
						<th>Creator</th>
                        <th>Title</th>
						<th>Featured Image</th>
						<th><small>Floor</small></th>
					</thead>
					<tbody>
					<?php foreach ($houses as $key => $house): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $house['manager']; ?></td>
							<td>
								<a 	target="_blank"
								href="<?php echo BASE_URL . 'single_house.php?house-slug=' . $house['slug'] ?>">
									<?php echo $house['title']; ?>	
								</a>
							</td>
							<td><img width='100' src='../static/images/<?php echo $house['image']; ?>' alt='image' ></td>
                            <td>
								<a 	target="_blank"
								href="<?php echo BASE_URL . 'single_house.php?house-slug=' . $house['slug'] ?>">
									<?php echo $house['name']; ?>	
								</a>
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
