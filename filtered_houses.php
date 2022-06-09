<?php include('config.php'); ?>
<?php include('includes/public_functions.php'); ?>
<?php include('includes/head_section.php'); ?>
<?php 
	// Get house-posts under a particular topic
	if (isset($_GET['floor'])) {
		$floor_id = $_GET['floor'];
		$houses = getPublishedHousesByFloor($floor_id);
	}
?>
	<title>RMS | Home </title>
</head>
<body>
<div class="container">
<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
<!-- // Navbar -->
<!-- content -->
<div class="content">
	<h2 class="content-title">
		Houses on <u><?php echo getFloorNameById($floor_id); ?></u>
	</h2>
	<hr>
	<?php foreach ($houses as $house): ?>
		<div class="house-post" style="margin-left: 0px;">
			<img src="<?php echo BASE_URL . '/static/images/' . $house['image']; ?>" class="house-post_image" alt="">
			<a href="single_house.php?house-slug=<?php echo $house['slug']; ?>">
				<div class="house-post_info">
					<h3><?php echo $house['title'] ?></h3>
					<div class="info">
						<span><?php echo date("F j, Y ", strtotime($house["created_at"])); ?></span>
						<span class="read_more">Explore...</span>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach ?>
</div>
<!-- // content -->
</div>
<!-- // container -->

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->