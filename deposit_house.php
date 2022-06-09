<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php  include('includes/head_section.php'); ?>

<?php 
	if (isset($_GET['deposit'])) {
		$house = getHouseForBookings($_GET['deposit']);
		$_SESSION['deposited'] = $_GET['deposit'];
	}
	// inserting records in the database table deposit table
	// mpesa code insertion
	if(isset($_POST['mpesa_btn'])) {
		global $conn;
		$user_id = $_POST['user_id'];
		$house_slug = $_POST['house_slug'];
		$deposit_amount = $_POST['deposit_amount'];
		$mode_of_pay = 'MPESA';
		$mpesa_code = $_POST['mpesa_code'];
		$query = "INSERT INTO house_deposit_tenant(user_id,house_slug,deposit_amount,mode_of_pay,pay_code,created_at) ";
		$query .= "VALUES('{$user_id}','{$house_slug}','{$deposit_amount}','{$mode_of_pay}','{$mpesa_code}',now()) ";
		$create_query = mysqli_query($conn,$query);
		$house_det = isset($_SESSION['deposited']);
		echo var_dump($house_det);
	
		if (!$create_query) {
		die('QUERY FAILED' . mysqli_error($conn));
		}
		header("Location: tenant_invoice.php?user_id=$user_id&house_slug=$house_slug");
	
	}
	// card insertion deposit
	if(isset($_POST['card_btn'])) {
		global $conn;
		$user_id = $_POST['user_id'];
		$house_slug = $_POST['house_slug'];
		$deposit_amount = $_POST['deposit_amount'];
		$mode_of_pay = 'CARD';
		$card_code = $_POST['card_code'];
		$query = "INSERT INTO house_deposit_tenant(user_id,house_slug,deposit_amount,mode_of_pay,pay_code,created_at) ";
		$query .= "VALUES('{$user_id}','{$house_slug}','{$deposit_amount}','{$mode_of_pay}','{$card_code}',now()) ";
		$create_query = mysqli_query($conn,$query);
		$house_det = isset($_SESSION['deposited']);
		echo var_dump($house_det);
	
		if (!$create_query) {
		die('QUERY FAILED' . mysqli_error($conn));
		}
		header("Location: tenant_invoice.php?user_id=$user_id&house_slug=$house_det");
	
	}
	// cash insertion code
	// card insertion deposit
	if(isset($_POST['cash_btn'])) {
		global $conn;
		$user_id = $_POST['user_id'];
		$house_slug = $_POST['house_slug'];
		$deposit_amount = $_POST['deposit_amount'];
		$mode_of_pay = 'CASH';
		$cash_code = $_POST['cash_only'];
		$query = "INSERT INTO house_deposit_tenant(user_id,house_slug,deposit_amount,mode_of_pay,pay_code,created_at) ";
		$query .= "VALUES('{$user_id}','{$house_slug}','{$deposit_amount}','{$mode_of_pay}','{$cash_code}',now()) ";
		$create_query = mysqli_query($conn,$query);
		$house_det = isset($_SESSION['deposited']);
		echo var_dump($house_det);
	
		if (!$create_query) {
		die('QUERY FAILED' . mysqli_error($conn));
		}
		header("Location: tenant_invoice.php?user_id=$user_id&house_slug=$house_det");
	
	}
?>
	<title>RMS | Deposits</title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="deposit_house.php" >
			<h2>DEPOSIT PAYMENT & TENANTS CLARIFICATINS</h2>
			<?php if (isset($_SESSION['user']['username'])) { ?>
			<input type="text" name="username" value="Tenant Name:<?php echo $_SESSION['user']['username'] ?>" placeholder="Username" readonly>
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>"  placeholder="id">
			<?php } ?>
			<input type="text" name="house" value="House Number:<?php echo $house['title']; ?>" placeholder="" readonly>
			<input type="text" name="house_slug" value="<?php echo $house['slug']; ?>" placeholder="">
			<input type="text" name="rent" value="Rent Price:<?php echo $house['price']; ?>" placeholder="Deposit Amount" readonly>
			<label>Deposit Amount</label>
			<input type="text" name="deposit_amount" value="<?php echo $house['price'] * 2; ?>" placeholder="Deposit Amount" readonly>
			<label>Mode OF Pay</label>
			<!--  -->
			<input type="button" onclick="myFunctionMpesa();" value="mpesa" name="mode_of_pay" />
			<!-- <input type="text" value="mpesa" name="mode_of_pay" /> -->
			<input type="button" onclick="myFunctionCard();" value="card" name="mode_of_pay" />
			<input type="button" onclick="myFunctionCash();" value="cash" name="mode_of_pay" />
			<!-- styling the buttons to default hidden -->
			<style>
			.mpesaCode{
			display: none;
			}
			.cardCode{
			display: none;
			}
			.cashOnly{
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
			<!-- buttons -->
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

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->