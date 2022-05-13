<!-- The first include should be config.php to enable this file communicate with the database -->
<?php require_once('config.php') ?>
<!--  public funtion is included so that functions applying to this files are called from it  -->
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<!-- code file for login and registration -->
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>

<!-- Retrieve all houses from database  -->
<?php $houses = getPublishedHouses(); ?>
<!-- head_section completes our html head structure with links to our styling files for the public area -->
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>RMS | Home </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- start navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
		<!-- // end navbar -->

		<!-- start banner -->
		<?php include( ROOT_PATH . '/includes/banner.php') ?>
		<!-- // end  banner -->

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Available Houses</h2>
			<hr>

			<!--querying the database to loop all published houses ... -->
				<?php foreach ($houses as $house): ?>
				<div class="post" style="margin-left: 0px;">
					<img src="<?php echo BASE_URL . '/static/images/' . $house['image']; ?>" class="post_image" alt="">
					<!-- Added this if statement... -->
					<?php if (isset($house['name'])): ?>
						<a 
							href="<?php echo BASE_URL . 'filtered_houses.php?floor=' . $house['floor_id'] ?>"
							class="btn category">
							<?php echo $house['name'] ?>
						</a>
					<?php endif ?>

					<a href="single_house.php?house-id=<?php echo $house['id']; ?>">
						<div class="post_info">
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
		<!-- // Page content end -->

		<!-- start footer -->
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
		<!-- // end footer -->
