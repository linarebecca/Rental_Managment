<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/house_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<!-- Get all floors -->
<?php $floors = getAllFloors();	?>
	<title>landlord | Create House</title>
</head>
<body>
	<!-- landlord navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- Middle form - to create and edit  -->
		<div class="action create-post-div">
			<h1 class="page-title">Add & Update House</h1>
			<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'admin/create_house.php'; ?>" >
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>

				<!-- if editing house, the id is required to identify that house -->
				<?php if ($isEditingHouse === true): ?>
					<input type="hidden" name="house_id" value="<?php echo $house_id; ?>">
				<?php endif ?>

				<input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title">
				<label style="float: left; margin: 5px auto 5px;">Featured image</label>
				<input type="file" name="featured_image" >
				<textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>
				<select name="floor_id">
					<option value="" selected disabled>Choose floor</option>
					<?php foreach ($floors as $floor): ?>
						<option value="<?php echo $floor['id']; ?>">
							<?php echo $floor['name']; ?>
						</option>
					<?php endforeach ?>
				</select>
				
				<!-- Only landlord users can view publish input field -->
				<?php if ($_SESSION['user']['role'] == "landlord"): ?>
					<!-- display checkbox according to whether post has been published or not -->
					<?php if ($published == true): ?>
						<label for="publish">
							Publish
							<input type="checkbox" value="1" name="publish" checked="checked">&nbsp;
						</label>
					<?php else: ?>
						<label for="publish">
							Publish
							<input type="checkbox" value="1" name="publish">&nbsp;
						</label>
					<?php endif ?>
				<?php endif ?>
				
				<!-- if editing post, display the update button instead of create button -->
				<?php if ($isEditingHouse === true): ?> 
					<button type="submit" class="btn" name="update_house">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_house">Save House</button>
				<?php endif ?>

			</form>
		</div>
		<!-- // Middle form - to create and edit -->
	</div>
</body>
</html>

<script>
	// CKEDITOR.replace('body');
</script>