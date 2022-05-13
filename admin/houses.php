<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/house_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

<!-- Get all landlord houses from DB -->
<?php $houses = getAllHouses(); ?>
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
						<thead>
						<th>N</th>
						<th>Creator</th>
                        <th>Title</th>
						<th>Views</th>
						<!-- Only landlord can publish/unpublish houses -->
						<?php if ($_SESSION['user']['role'] == "landlord"): ?>
							<th><small>Publish</small></th>
						<?php endif ?>
						<th><small>Edit</small></th>
						<th><small>Delete</small></th>
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
							<td><?php echo $house['views']; ?></td>
							
							<!-- Only landlord can publish/unpublish houses -->
							<?php if ($_SESSION['user']['role'] == "landlord" ): ?>
								<td>
								<?php if ($house['published'] == true): ?>
									<a class="fa fa-check btn unpublish"
										href="houses.php?unpublish=<?php echo $house['id'] ?>">
									</a>
								<?php else: ?>
									<a class="fa fa-times btn publish"
										href="houses.php?publish=<?php echo $house['id'] ?>">
									</a>
								<?php endif ?>
								</td>
							<?php endif ?>

							<td>
								<a class="fa fa-pencil btn edit"
									href="create_house.php?edit-house=<?php echo $house['id'] ?>">
								</a>
							</td>
							<td>
								<a  class="fa fa-trash btn delete" 
									href="create_house.php?delete-house=<?php echo $house['id'] ?>">
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
