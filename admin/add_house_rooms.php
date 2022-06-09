<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/house_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>landlord | Add House Rooms</title>
</head>
<body>
	<!-- landlord navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- Middle form - to create and edit  -->
		<div class="action create-post-div">
			<h1 class="page-title">Add House Rooms</h1>
			<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'admin/add_house_rooms.php'; ?>" >
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
                <?php
                            if (isset($_GET['rooms'])) {
                            $house_slug = $_GET['rooms'];
                            ?>
				<input type="hidden" name="house_slug" value="<?php echo $house_slug; ?>" placeholder="ADD HOUSE LABEL">
                <?php } ?>
				<label style="float: left; margin: 5px auto 5px;">Room image</label>
				<input type="file" name="image" >
                <label style="float: left; margin: 5px auto 5px;">Room Descriptions</label>
				<textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>
				<button type="submit" class="btn" name="upload_room">Save</button>
                <?php
                // Create database connection
                $db = mysqli_connect("localhost", "root", "", "onlinerentalsdb");

                // Initialize message variable
                $msg = "";

                // If upload button is clicked ...
                if (isset($_POST['upload_room'])) {
                // Get image name
                $image = $_FILES['image']['name'];
                // Get text
                $body = mysqli_real_escape_string($db, $_POST['body']);
                $house_slug = mysqli_real_escape_string($db, $_POST['house_slug']);


                // image file directory
                $target = "../static/images/".basename($image);

                $sql = "INSERT INTO house_images (house_slug, room_image, description) VALUES ('$house_slug','$image', '$body')";
                // execute query
                mysqli_query($db, $sql);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
                }else{
                $msg = "Failed to upload image";
                }
                header("Location: rooms.php");
                }
                $result = mysqli_query($db, "SELECT * FROM house_image");
                ?>


			</form>
		</div>
		<!-- // Middle form - to create and edit -->
	</div>
</body>
</html>
