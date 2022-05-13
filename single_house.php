<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
	if (isset($_GET['house-id'])) {
		$house = getHouse($_GET['house-id']);
		$house_images = getHouseImages($_GET['house-id']);
		$_SESSION['house_id'] = $house;
		$_SESSION['house_id_image'] = $house_images;
	}
	$floors = getAllFloors();
	// $house_images = getHouseImageById($house);
?>
<?php include('includes/head_section.php'); ?>
<title> <?php echo $house['title'] ?> | RMS</title>
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
			<?php if ($house['published'] == false): ?>
				<h2 class="post-title">Ups!... This house is occupied</h2>
			<?php else: ?>
				<h2 class="post-title"><?php echo $house['title']; ?></h2>
				<div class="post-body-div">
					<?php echo html_entity_decode($house['body']); ?>
				</div>
			</div>
			<!-- // full post div -->
			
			<!-- image section -->
			<div class="post" style="margin-left: 0px;">
					<img src="<?php echo BASE_URL . '/static/images/' . $house_images['image']; ?>" class="post_image" alt="">
					<!-- Added this if statement... -->
						<a 
							href="#"
							class="btn category">
							<?php echo $house['title'] ?>
						</a>
						<div class="post_info">
							<h3><?php echo $house_images['description'] ?></h3>
							<div class="info">
								<span><?php echo date("F j, Y ", strtotime($house["created_at"])); ?></span>
							</div>
						</div>
				</div>
			<?php endif ?>
			<hr>
		</div>
		<!-- // Page wrapper -->

		<!-- post sidebar -->
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Floors</h2>
				</div>
				<div class="card-content">
					<?php foreach ($floors as $floor): ?>
						<a 
							href="<?php echo BASE_URL . 'filtered_houses.php?floor=' . $floor['id'] ?>">
							<?php echo $floor['name']; ?>
						</a> 
					<?php endforeach ?>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h2>Click!</h2>
					<!-- check if user is in session -->
			<?php if (isset($_SESSION['user']['username'])) { ?>
			<!-- if in session display deposit button -->
			<a href="<?php echo BASE_URL . 'deposit_house.php?deposit=' . isset($_GET['house-id']); ?>" class="btn category">DEPOSIT THIS HOUSE</a>
			<!-- if not in session -->
			<?php }else{ ?>
				<a href="<?php echo BASE_URL . 'login.php'; ?>" class="btn category">LOGIN TO DEPOSIT THIS HOUSE</a>
			<?php } ?>
				</div>
			</div>
		</div>
		<!-- // post sidebar -->
	</div>
</div>
<!-- // content -->

<?php include( ROOT_PATH . '/includes/footer.php'); ?>