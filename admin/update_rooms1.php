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
			<h1 class="page-title">Update House Rooms</h1>
			<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'admin/update_rooms.php'; ?>" >
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
                <?php
                $db = mysqli_connect("localhost", "root", "", "onlinerentalsdb");
                          if (isset($_GET['edit'])) {
                            $room = $_GET['edit'];
                            $query = "SELECT * FROM house_images JOIN houses ON houses.slug=house_images.house_slug WHERE room_id = $room ";
                            $select_rooms_id = mysqli_query($db,$query);
                            while($row = mysqli_fetch_assoc($select_rooms_id)) {
                                $room_id = $row['room_id'];
                                $house_slug = $row['house_slug'];
                                $body = $row['description'];
                                $room_image = $row['room_image'];
                                $_SESSION['room_id'] = $room_id;
                                ?>
				<input type="hidden" name="house_id" value="<?php echo $house_id; ?>" placeholder="ADD HOUSE LABEL">
				<label style="float: left; margin: 5px auto 5px;">Room image</label>
                <input type="text" name="" value="<?php echo $room_image; ?>">
				<input type="file" name="image">
				<textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>
                <?php } } ?>
				<button type="submit" class="btn" name="upload_room_update">Update</button>
                <?php
                // Create database connection
                $db = mysqli_connect("localhost", "root", "", "onlinerentalsdb");

                // Initialize message variable
                $msg = "";

                // If upload button is clicked ...
                if (isset($_POST['upload_room_update'])) {
                // Get image name
                $image = $_FILES['image']['name'];
                // Get text
                $body = mysqli_real_escape_string($db, $_POST['body']);
                $house_id = mysqli_real_escape_string($db, $_POST['house_id']);


                // image file directory
                $target = "../static/images/".basename($image);

                $query = "UPDATE house_images SET house_id = '{$house_id}',  image = '{$image}', description = '{$body}' WHERE room_id = {$_SESSION['room_id']} ";
                $update_query = mysqli_query($db,$query);
               
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
