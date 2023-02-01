<?php  
session_start();
require_once "../config/connect.php";

if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
	header('location: login.php');
}

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = filter_var($_GET['id'],  FILTER_SANITIZE_NUMBER_INT);
} else {
	header('location: orders.php');
}

$osql = "SELECT * FROM orders WHERE id=$id";
$ores = mysqli_query($conn, $osql);
$or = mysqli_fetch_assoc($ores);


if(isset($_POST['paynow']) && !empty($_POST['paynow'])){
	$status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
	$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

	$cansql = "INSERT INTO ordertracking (orderid, status, message) VALUES ('$id', 'status', '$message')";
	$canres = mysqli_query($conn, $cansql) or die(mysqli_error($connection));
	if($canres){
		$ordupd = "UPDATE orders SET orderstatus='$status' WHERE id=$id";
		if(mysqli_query($conn, $ordupd)){
			header('location: orders.php');
		}
	}
}

?>

<?php require('inc/header.php'); ?>
<?php require('inc/nav.php'); ?>

<!-- SHOP CONTENT -->
<section id="content">
	<div class="content-blog">
		<div class="page_header text-center">
			<h2>Shop - Order Processing</h2>
			<!-- <p>Get the best kit for smooth shave</p> -->
		</div>


		<form method="POST">
			<div class="container">
				<div class="col-md-12">

					<h3>Detail Orders</h3>
					<br>
					<table class="cart-table account-table table table-bordered">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if (isset($_GET['id']) && !empty($_GET['id'])) {
								$oid = $_GET['id'];
							} else {
								header('location: my-account.php');
							}
							$sql = "SELECT * FROM
							(SELECT * FROM orderitems WHERE orderid=$oid) AS it
							INNER JOIN (SELECT id AS proid, name, thumb FROM products) AS pro
							ON pro.proid=it.productid";
								// die();
							$res = mysqli_query($conn, $sql);

							while ($r=mysqli_fetch_assoc($res)) {
								?>
								<tr>
									<td>
										<?php echo $r['id']; ?>
									</td>
									<td>
										<a href="#"><img src="<?php echo $r['thumb']; ?>" alt="" height="90" width="90"></a>					
									</td>
									<td>
										<a href="single.php?id=<?php echo $key; ?>">
											<?php
											$namepro = $r['name']; 
											$lenlimit = min(strlen($r['name']), 30);

											$namepro = substr($namepro, 0, $lenlimit);
											echo $namepro; 
											?>
										</a>					
									</td>
									<td>
										<span class="amount">£<?php echo $r['price']; ?></span>
									</td>
									<td>
										<div class="quantity"><?php echo $r['quant']; ?></div>
									</td>
									<td>
										<span class="amount">£ <?php echo $r['quant'] * $r['price']; ?></span>					
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="billing-details">
							<h3 class="uppercase">Order Processing</h3>
							<label class="">Order Status </label>
							<select name="status" class="form-control">
								<option value="">Select Status</option>
								<?php  
									$st = ['Order Placed', 'In progress', 'Dispatched', 'Delivered', 'Cancelled'];
									foreach ($st as $value) {
								?>
									<option value="<?php echo $value; ?>" <?php if($or['orderstatus']==$value) {echo "selected";} ?> ><?php echo $value; ?></option>
								<?php } ?>
							</select>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-12">
									<label>Message</label>
									<textarea name="message" class="form-control" placeholder="" rows="5"></textarea>
								</div>
							</div>
							<div class="clearfix space30"></div>
							<div class="space30"></div>
							<input  type="submit" name="paynow" class="button btn-lg" value="Update Order">
						</div>
					</div>
				</div>
			</div>		
		</form>
	</div>
</section>

<?php require('inc/footer.php'); ?>