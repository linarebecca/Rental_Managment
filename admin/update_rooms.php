<?php  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/house_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>landlord | Add House Images</title>
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
                <img width="100" src="../static/images/<?php echo $room_image; ?>" alt="room-image" style="float: left;">
                <label style="float: left; margin: 5px auto 5px;">Room image</label>
                <input type="file" name="image" value="<?php echo $room_image; ?>" >
				<textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>
                <?php } } ?>
				<button type="submit" class="btn" name="upload_room_update">Update</button>
                <?php
            $db = mysqli_connect("localhost", "root", "", "onlinerentalsdb");
            if(isset($_POST['upload_room_update'])){
                //text data variables
            $body=$_POST['body'];
            $house_id=$_POST['house_id'];
            $update_id = $_SESSION['room_id'];
            $room_image = $_FILES['image']['name'];
            $room_image_temp = $_FILES['image']['tmp_name'];
    
            
            move_uploaded_file($room_image_temp, "../static/images/$room_image");
            // KEEPING THE IMAGE FROM DISAPEARING
            if(empty($room_image)) {
            
            $query = "SELECT * FROM house_images WHERE room_id = $update_id ";
            $select_image = mysqli_query($db,$query);
                
            while($row = mysqli_fetch_array($select_image)) {
                
            $room_image = $row['room_image'];
            
            }
        }
    
        
            $query = "UPDATE house_images SET ";
            $query .="description  = '{$body}', ";
            $query .="room_image  = '{$room_image}' ";
            $query .= "WHERE room_id = {$update_id} ";
            
            $update_room= mysqli_query($db,$query);
             
            $_SESSION['message'] = "updated successfully";
            header("Location: rooms.php");
        }
                ?>
               


			</form>
		</div>
		<!-- // Middle form - to create and edit -->
	</div>
</body>
</html>
