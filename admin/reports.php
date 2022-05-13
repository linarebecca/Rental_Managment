<?php  include('../config.php'); ?>
	<?php include(ROOT_PATH . '/landlord/includes/landlord_functions.php'); ?>
	<?php include(ROOT_PATH . '/landlord/includes/head_section.php'); ?>
	<title>landlord | Dashboard</title>
</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="<?php echo BASE_URL .'landlord/dashboard.php' ?>">
				<h1>RMS - landlord</h1>
			</a>
		</div>
		<?php if (isset($_SESSION['user'])): ?>
			<div class="user-info">
				<span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; 
				<a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">logout</a>
			</div>
		<?php endif ?>
	</div>
	<div class="container dashboard">
		<h1>RMS REPORTS</h1>
		<div class="stats">
			<a href="users.php" class="first">
				<span>43</span> <br>
				<span>Newly registered tenants</span>
			</a>
			<a href="houses.php">
				<span>43</span> <br>
				<span>Published houses</span>
			</a>
			<a>
				<span>43</span> <br>
				<span>payment</span>
			</a>
		</div>
		<br><br><br>
		<div class="buttons">
			<a href="dashboard.php">menu</a>
			<!-- <a href="houses.php">Add house</a> -->
		</div>
	</div>
</body>
</html>