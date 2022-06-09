<!-- The config.php enables this file to communicate with the database and should be included as first -->
<?php require_once('config.php') ?>
<!--  public funtion is included so that functions applying to this files are called from it  -->
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<!-- code file for login and registration -->
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>

<!-- Retrieve all houses from database by calling getPublishedHouses() function  -->
<?php $houses = getPublishedHouses(); ?>
<!-- head_section completes our html head structure with links to our styling files for the public area -->
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>RMS | Home </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- start navigation -->
		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
		<!-- // end navigation -->

		<!-- start banner -->
		<?php include( ROOT_PATH . '/includes/banner.php') ?>
		<!-- // end  banner -->

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Available Houses</h2>
			<hr>

			<!--querying the database to loop all published houses ... -->
				<?php foreach ($houses as $house): ?>
				<div class="house-post" style="margin-left: 0px;">
					<img src="<?php echo BASE_URL . '/static/images/' . $house['image']; ?>" class="house-post_image" alt="">
					<!-- check for floors of this houses... -->
					<?php if (isset($house['floor']['name'])): ?>
					<a 
						href="<?php echo BASE_URL . 'filtered_houses.php?floor=' . $house['floor']['id'] ?>"
						class="btn floors">
						<?php echo $house['floor']['name'] ?>
					</a>
					<?php endif ?>
					<!-- passing the house slug -->
					<a href="single_house.php?house-slug=<?php echo $house['slug']; ?>">
						<div class="house-post_info">
							<h3>House Number:<?php echo $house['title'] ?></h3>
							<div class="info">
								<span>Date Posted:<?php echo date("F j, Y ", strtotime($house["created_at"])); ?></span>
								<span class="house_rooms">Explore rooms...</span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
		</div>
		<!-- // Page content end -->

		<!-- start footer -->
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
		<!-- // end footer -->
