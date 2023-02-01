<?php  
session_start();
require_once 'config/connect.php';

if(!isset($_SESSION['customer']) && empty($_SESSION['customer'])){
	header('location: login.php');
}

$uid = $_SESSION['customerid'];
$carts = [];
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
	$carts = $_SESSION['cart'];
}


if(isset($_POST['paynow']) && !empty($_POST['paynow'])){

	$country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
	$fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
	$lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
	$company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
	$address1 = filter_var($_POST['address1'], FILTER_SANITIZE_STRING);
	$address2 = filter_var($_POST['address2'], FILTER_SANITIZE_STRING);
	$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
	$state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
	$zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
	$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
	$email = filter_var($_SESSION['customer'], FILTER_SANITIZE_EMAIL);


	$usql = "UPDATE usersmeta SET 
	country='$country',
	firstname='$fname',
	lastname='$lname',
	company='$company',
	address1='$address1',
	address2='$address2',
	city='$city',
	state='$state',
	zip='$zipcode',
	mobile='$phone'
	WHERE uid='$uid'";

	$ures = mysqli_query($conn, $usql);
	if($ures){
		$smsg = "Address Updated";
	} else {
		$fmsg = "Address Update Category";
	}
}

$sql = "SELECT * FROM usersmeta WHERE uid=$uid";
$res = mysqli_query($conn, $sql);
$r = mysqli_fetch_assoc($res);

?>

<?php require('inc/header.php'); ?>
<?php require('inc/nav.php'); ?>

<!-- SHOP CONTENT -->
<section id="content">
	<div class="content-blog">
		<div class="page_header text-center">
			<h2>Shop - Update</h2>
			<p>Get the best kit for smooth shave</p>
		</div>


		<form method="POST">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="billing-details">
							<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
							<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
							<h3 class="uppercase">Update Billing Details</h3>
							<div class="space30"></div>
							<label class="">Country </label>
							<select name="country" class="form-control">
								<option value="">Select Country</option>
								<option value="AX">Aland Islands</option>
								<option value="AF">Afghanistan</option>
								<option value="AL">Albania</option>
								<option value="DZ">Algeria</option>
								<option value="AD">Andorra</option>
								<option value="AO">Angola</option>
								<option value="AI">Anguilla</option>
								<option value="AQ">Antarctica</option>
								<option value="AG">Antigua and Barbuda</option>
								<option value="AR">Argentina</option>
								<option value="AM">Armenia</option>
								<option value="AW">Aruba</option>
								<option value="AU">Australia</option>
								<option value="AT">Austria</option>
								<option value="AZ">Azerbaijan</option>
								<option value="BS">Bahamas</option>
								<option value="BH">Bahrain</option>
								<option value="BD">Bangladesh</option>
								<option value="BB">Barbados</option>
							</select>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-6">
									<label>First Name </label>
									<input name="fname" class="form-control" placeholder="" value="<?php if(!empty($r['firstname'])){echo $r['firstname'];} elseif(isset($fname)) { echo $fname; } ?>" type="text">
								</div>
								<div class="col-md-6">
									<label>Last Name </label>
									<input name="lname" class="form-control" placeholder="" value="<?php if(!empty($r['lastname'])){echo $r['lastname'];} elseif(isset($lname)) { echo $lname; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label>Company Name</label>
							<input name="company" class="form-control" placeholder="" value="<?php if(!empty($r['company'])){echo $r['company'];} elseif(isset($company)) { echo $company; } ?>" type="text">
							<div class="clearfix space20"></div>
							<label>Address </label>
							<input name="address1" class="form-control" placeholder="Street address" value="<?php if(!empty($r['address1'])){echo $r['address1'];} elseif(isset($address1)) { echo $address1; } ?>" type="text">
							<div class="clearfix space20"></div>
							<input name="address2" class="form-control" placeholder="Apartment, suite, unit etc. (optional)" value="<?php if(!empty($r['address2'])){echo $r['address2'];} elseif(isset($address2)) { echo $address2; } ?>" type="text">
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-4">
									<label>Town / City </label>
									<input name="city" class="form-control" placeholder="Town / City" value="<?php if(!empty($r['city'])){echo $r['city'];} elseif(isset($city)) { echo $city; } ?>" type="text">
								</div>
								<div class="col-md-4">
									<label>County</label>
									<input name="state" class="form-control" value="<?php if(!empty($r['state'])){echo $r['state'];}elseif(isset($state)) { echo $state; } ?>" placeholder="State / County" type="text">
								</div>
								<div class="col-md-4">
									<label>Postcode </label>
									<input name="zipcode" class="form-control" placeholder="Postcode / Zip" value="<?php if(!empty($r['zip'])){echo $r['zip'];} elseif(isset($zipcode)) { echo $zipcode; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label>Phone </label>
							<input name="phone" class="form-control" id="billing_phone" placeholder="" value="<?php if(!empty($r['mobile'])){echo $r['mobile'];} elseif(isset($phone)) { echo $phone; } ?>" type="text">

							<div class="clearfix space30"></div>
							<div class="space30"></div>
							<input  type="submit" name="paynow" class="button btn-lg" value="Update Address">
						</div>
					</div>
				</div>
			</div>		
		</form>
	</div>
</section>

<?php require('inc/footer.php'); ?>