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
	$id = filter_var($_GET['id'],  FILTER_SANITIZE_NUMBER_INT);
	$reason = filter_var($_POST['reason'], FILTER_SANITIZE_STRING);

	$cansql = "INSERT INTO ordertracking (orderid, status, message) VALUES ('$id', 'Cancelled', '$reason')";
	$canres = mysqli_query($conn, $cansql) or die(mysqli_error($connection));
	if($canres){
		$ordupd = "UPDATE orders SET orderstatus='Cancelled' WHERE id=$id";
		if(mysqli_query($conn, $ordupd)){
			header('location: my-account.php');
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
			<h2>Shop - Cancel</h2>
			<p>Get the best kit for smooth shave</p>
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
										<a href="#"><img src="admin/<?php echo $r['thumb']; ?>" alt="" height="90" width="90"></a>					
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
							<h3 class="uppercase">Cancel Order</h3>
							<div class="space30"></div>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-12">
									<label>Reason</label>
									<textarea name="reason" class="form-control" placeholder="" rows="5"></textarea>
								</div>
							</div>
							<div class="clearfix space30"></div>
							<div class="space30"></div>
							<input  type="submit" name="paynow" class="button btn-lg" value="Cancel Order">
						</div>
					</div>
				</div>
			</div>		
		</form>
	</div>
</section>

<?php require('inc/footer.php'); ?>