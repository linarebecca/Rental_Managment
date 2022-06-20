<?php

use LDAP\Result;

  include('../config.php'); ?>
<?php  include('../check_session.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/landlord_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/house_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<!-- Get all subscribers -->
<?php $subscribers = getAllSubscribers();	?>
<?php $houses = getAllHouses();	?>
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
			<h1 class="page-title">BOOK HOUSE BY DEPOSIT</h1>
			<form id="partnersearchform" method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'admin/tenant_deposit_bookings.php'; ?>" >
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
				<select name="user_id">
					<option value="" selected disabled>Select Tenant Subscriber</option>
					<?php foreach ($subscribers as $sub): ?>
						<option value="<?php echo $sub['id']; ?>">
							<?php echo $sub['fullname']; ?>
						</option>
					<?php endforeach ?>
				</select>

				<select name="house_slug">
					<option value="" selected enabled>Select House Number</option>
					<?php foreach ($houses as $house): ?>
						<a href="selected=<?php echo $house['slug']; ?>"><option value="<?php echo $house['slug']; ?>"></a>
							<?php echo $house['title']; ?>
						</option>
					<?php endforeach ?>
				</select>	
				<input type="text" name="rent_amount" placeholder="Deposit Amount" >	
			<input type="button" style="padding: 20px;
			background-color: black;
			color: whitesmoke; border-radius: 40px;" onclick="myFunctionMpesa();" value="mpesa" name="mode_of_pay" />
			<!-- <input type="text" value="mpesa" name="mode_of_pay" /> -->
			<input style="padding: 20px;
			background-color: black;
			color: whitesmoke; border-radius: 40px;"  type="button" onclick="myFunctionCard();" value="card" name="mode_of_pay" />
			<input style="padding: 20px;
			background-color: black;
			color: whitesmoke; border-radius: 40px;"  type="button" onclick="myFunctionCash();" value="cash" name="mode_of_pay" />
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

			</form>
		</div>
		<!-- // Middle form - to create and edit -->
	</div>
</body>
</html>
