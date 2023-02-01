<?php  
session_start();
ob_start();
require_once 'config/connect.php';

if(!isset($_SESSION['customer']) && empty($_SESSION['customer'])){
	header('location: login.php');
}

$uid = $_SESSION['customerid'];
?>

<?php require('inc/header.php'); ?>
<?php require('inc/nav.php'); ?>

<!-- SHOP CONTENT -->
<section id="content">
	<div class="content-blog content-account">
		<div class="container">
			<div class="row">
				<div class="page_header text-center">
					<h2>My Account</h2>
				</div>
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
										<a href="single.php?id=<?php echo $r['productid']; ?>">
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

					<br>
					<br>
					<br>

					<div class="ma-address">
						<h3>My Addresses</h3>
						<p>The following addresses will be used on the checkout page by default.</p>

						<div class="row">
							<div class="col-md-6">
								<h4>Billing Address <a href="#">Edit</a></h4>
								<?php  
									$csql = "SELECT * FROM usersmeta";
									$cres = mysqli_query($conn, $csql);
									$cr = mysqli_fetch_assoc($cres);

									echo "<p>".$cr['firstname'].' '.$cr['lastname']."</p>";
									echo "<p>".$cr['address1']."</p>";
									echo "<p>".$cr['address2']."</p>";
									echo "<p>".$cr['city']."</p>";
									echo "<p>".$cr['state']."</p>";
									echo "<p>".$cr['country']."</p>";
									echo "<p>".$cr['company']."</p>";
									echo "<p>".$cr['zip']."</p>";
									echo "<p>".$cr['mobile']."</p>";
									echo "<p>".$_SESSION['customer']."</p>";

								?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>

<?php require('inc/footer.php'); ?>
