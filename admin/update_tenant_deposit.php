<?php



  include('../config.php');
  $email=$_GET['edit-tenant'];
  $errors=array();
  $sql="SELECT * FROM users WHERE email='$email'";
  $res=mysqli_query($conn, $sql);
  if ($res) {
	  //   $tenant = mysqli_fetch_all($res, MYSQLI_ASSOC);
	  //   echo var_dump($tenant);
	  while ($row=mysqli_fetch_assoc($res)) {
		  $userId=$row['id'];
		  $userNames=$row['fullname'];
		  $query="SELECT * FROM house_deposit_tenant WHERE user_id='$userId'";
		  $results=mysqli_query($conn, $query);
		  if ($res) {
			while ($row=mysqli_fetch_assoc($results)) {
				$house_no=$row['house_slug'];
				$amount=$row['deposit_amount']/2;
			}
		  }


	  }
	//   echo $email;
  }else{
	echo mysqli_error($conn);
  }
  if(isset($_POST['mpesa_btn'])) {
	global $conn;
	$mode_of_pay = 'MPESA';
	$mpesa_code = $_POST['mpesa_code'];
	$query = "INSERT INTO monthly_payments(user_id,house_slug,amount,mode_of_pay,pay_code,created_at) ";
	$query .= "VALUES('{$userId}','{$house_no}','{$amount}','{$mode_of_pay}','{$mpesa_code}',now()) ";
	$create_query = mysqli_query($conn,$query);
	$house_det = isset($_SESSION['deposited']);
	echo var_dump($house_det);

	if (!$create_query) {
	die('QUERY FAILED' . mysqli_error($conn));
	}
	header("Location: monthly_payments_invoice.php?user_id=$user_id&house_slug=$house_slug");

}
  if(isset($_POST['card_btn'])) {
	global $conn;
	$mode_of_pay = 'CARD';
	$card_code = $_POST['card_code'];
	$query = "INSERT INTO monthly_payments(user_id,house_slug,amount,mode_of_pay,pay_code,created_at) ";
	$query .= "VALUES('{$userId}','{$house_no}','{$amount}','{$mode_of_pay}','{$card_code}',now()) ";
	$create_query = mysqli_query($conn,$query);
	$house_det = isset($_SESSION['deposited']);
	echo var_dump($house_det);

	if (!$create_query) {
	die('QUERY FAILED' . mysqli_error($conn));
	}
	header("Location: monthly_payments_invoice.php?user_id=$user_id&house_slug=$house_det");

}
// cash insertion code
// card insertion deposit
if(isset($_POST['cash_btn'])) {
	global $conn;
	$mode_of_pay = 'CASH';
	$cash_code = $_POST['cash_only'];
	$query = "INSERT INTO monthly_payments(user_id,house_slug,amount,mode_of_pay,pay_code,created_at) ";
	$query .= "VALUES('{$userId}','{$house_no}','{$amount}','{$mode_of_pay}','{$cash_code}',now()) ";
	$create_query = mysqli_query($conn,$query);
	$house_det = isset($_SESSION['deposited']);
	echo var_dump($house_det);

	if (!$create_query) {
	die('QUERY FAILED' . mysqli_error($conn));
	}
	header("Location: monthly_payments_invoice.php?user_id=$user_id&house_slug=$house_det");

}
if (isset($_POST['update_user_det'])) {
	global $conn, $errors;
	$user_names=$_POST['userNames'];
	if (empty($user_names)) {
		array_push($errors, 'Username cannot be updated to empty');
	}else{
		$sql="UPDATE users SET fullname='$user_names' WHERE email='$email'";
		$res=mysqli_query($conn, $sql);
		$_SESSION['message']='User details updated';
		header("Location: tenants.php");
	}
}
  
  ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>landlord | Book House</title>
</head>
<body>
	<!-- landlord navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- Middle form - to create and edit  -->
		<div class="action create-post-div">
			<h1 class="page-title">RENEW TENANT HOUSE </h1>
			
			<form id="partnersearchform" method="post" enctype="multipart/form-data" action="" >
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
				<label for="user_id" style="padding-bottom:10px !important">User ID : </label>
				<input type="text" readonly value="<?php echo $userId?>" name="user_id" >
				<label for="house_slug" style="padding-bottom:10px !important">House N&deg; : </label>
				<input type="text" readonly value="<?php echo $house_no?>" name="house_slug" >
				<label for="userNames" style="padding-bottom:10px !important">User Full Names : </label>
				<input type="text" value="<?php echo $userNames?>" name="userNames" >

				<button type="submit" class="btn"  name="update_user_det">Submit</button>

				
			<!-- <input type="button" style="padding: 20px;
			background-color: black;
			color: whitesmoke; border-radius: 40px;" onclick="myFunctionMpesa();" value="mpesa" name="mode_of_pay" /> -->
			<!-- <input type="text" value="mpesa" name="mode_of_pay" /> -->
			<!-- <input style="padding: 20px;
			background-color: black;
			color: whitesmoke; border-radius: 40px;"  type="button" onclick="myFunctionCard();" value="card" name="mode_of_pay" />
			<input style="padding: 20px;
			background-color: black;
			color: whitesmoke; border-radius: 40px;"  type="button" onclick="myFunctionCash();" value="cash" name="mode_of_pay" /> -->
			<!-- styling the buttons to default hidden -->
			<style>
			#mpesaCode{
			display: none;
			}
			#cardCode{
			display: none;
			}
			#cashOnly{
			display: none;
			}
			#saveMpesaCode{
			display: none;
			}
			#saveCardCode{
			display: none;
			}
			#saveCashOnly{
			display: none;
			}

			</style>
			<input type="text" class="mpesaCode" id="mpesaCode" name="mpesa_code" value="" placeholder="ENTER MPESA CODE">
			<input type="text" class="cardCode"id="cardCode" name="card_code" value="" placeholder="ENTER Card CODE">
			<input type="text" class="cashOnly" id="cashOnly" name="cash_only" value="cash" placeholder="filled" readonly>
			<button type="submit" class="btn" id="saveMpesaCode" name="mpesa_btn">Submit</button>
			<button type="submit" class="btn" id="saveCardCode" name="card_btn">Submit</button>
			<button type="submit" class="btn" id="saveCashOnly" name="cash_btn">Submit</button>
		</form>
	</div>
</div>
<!-- // container -->
<!-- javascript code -->
<script>
function myFunctionMpesa() {
  var mpesaD = document.getElementById("mpesaCode");
  var cardD= document.getElementById("cardCode");
  var CASHd = document.getElementById("cashOnly");
  var saveMpesa = document.getElementById("saveMpesaCode");
  var saveCard = document.getElementById("saveCardCode");
  var saveCash = document.getElementById("saveCashOnly");
  if (mpesaD.style.display === "none") {
    mpesaD.style.display = "block";
    cardD.style.display = "none";
    CASHd.style.display = "none";
    saveMpesa.style.display = "block";
    saveCard.style.display = "none";
    saveCash.style.display = "none";
    
  } else {
    mpesaD.style.display = "none";
    cardD.style.display = "none";
    CASHd.style.display = "none";
    saveMpesa.style.display = "none";
    saveCard.style.display = "none";
    saveCash.style.display = "none";
 }
}
// code for paying whole rent
function myFunctionCard() {
  var mpesaD = document.getElementById("mpesaCode");
  var cardD= document.getElementById("cardCode");
  var CASHd = document.getElementById("cashOnly");
  var saveMpesa = document.getElementById("saveMpesaCode");
  var saveCard = document.getElementById("saveCardCode");
  var saveCash = document.getElementById("saveCashOnly");
  if (cardD.style.display === "none") {
    cardD.style.display = "block";
    mpesaD.style.display = "none";
    CASHd.style.display = "none";
    saveMpesa.style.display = "none";
    saveCard.style.display = "block";
    saveCash.style.display = "none";
    
  } else {
    mpesaD.style.display = "none";
    cardD.style.display = "none";
    CASHd.style.display = "block";
    saveMpesa.style.display = "none";
    saveCard.style.display = "none";
    saveCash.style.display = "block";

  }
}
// code for enquiries
function myFunctionCash() {
var mpesaD = document.getElementById("mpesaCode");
  var cardD= document.getElementById("cardCode");
  var CASHd = document.getElementById("cashOnly");
  var saveMpesa = document.getElementById("saveMpesaCode");
  var saveCard = document.getElementById("saveCardCode");
  var saveCash = document.getElementById("saveCashOnly")
  if (CASHd.style.display === "none") {
    CASHd.style.display = "block";
    mpesaD.style.display = "none";
    cardD.style.display = "none";
    saveMpesa.style.display = "none";
    saveCard.style.display = "none";
    saveCash.style.display = "block";
    
  } else {
    mpesaD.style.display = "none";
    CASHd.style.display = "none";
    cardD.style.display = "none";
    saveMpesa.style.display = "none";
    saveCard.style.display = "none";
    saveCash.style.display = "block";

  }
}
</script>

			</form>
		</div>
		<!-- // Middle form - to create and edit -->
	</div>
</body>
</html>
