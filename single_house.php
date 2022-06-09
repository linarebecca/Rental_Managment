<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
	if (isset($_GET['house-slug'])) {
		$house = getHouse($_GET['house-slug']);
		// $house_images = getAllHouseImages($_GET['house-slug']);
		$_SESSION['house_slug'] = $house;
		$_SESSION['house_slug_image'] = $_GET['house-slug'];
	}
	$floors = getAllFloors();
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
		<div class="house-post-wrapper">
			<!-- full house-post div -->
			<div class="full-house-post-div">
			<?php if ($house['published'] == false): ?>
				<h2 class="house-post-title">Ups!... This house is occupied</h2>
			<?php else: ?>
				<h2 class="house-post-title"><?php echo $house['title']; ?></h2>
				<div class="house-post-body-div">
					<?php echo html_entity_decode($house['body']); ?>
				</div>
			</div>
			<!-- // full house-post div -->
			<?php endif ?>
			<!-- image section -->
			<div class="image-section">
				<?php 
				   $slug = $_SESSION['house_slug_image'];
					$query = "SELECT * FROM house_images WHERE house_slug LIKE '%$slug%' ";
                    $results= mysqli_query($conn,$query);
                    $i=0;
                    while ($row = mysqli_fetch_assoc($results)) {
                        $i++;
                        $room_id = $row['room_id'];
                        $room_image = $row['room_image'];
                        $description = $row['description'];
                        echo "<div class='house-post' style='margin-left: 0px;'>";
                        echo "<img src='static/images/$room_image' class='house-post_image' alt=''>";
                        echo "<div class='house-post_info'>";
                        echo "<h3>$description</h3>";
						echo "<h4>NO:$i</h4>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>

			
			</div>
		</div>
		<!-- // Page wrapper -->

		<!-- house-post sidebar -->
		<div class="house-post-sidebar">
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
			<?php
			if (isset($_GET['house-slug'])) {
			$house_slug = $_GET['house-slug'];}
			?>
			<a href="<?php echo BASE_URL . 'deposit_house.php?deposit=' . $house_slug; ?>" class="btn floor">DEPOSIT THIS HOUSE</a>
			<!-- if not in session -->
			<?php }else{ ?>
				<a href="<?php echo BASE_URL . 'login.php'; ?>" class="btn floor">LOGIN TO DEPOSIT THIS HOUSE</a>
			<?php } ?>
				</div>
			</div>
		</div>
		<!-- // house-post sidebar -->
	</div>
</div>
<!-- // content -->

<?php include( ROOT_PATH . '/includes/footer.php'); ?>