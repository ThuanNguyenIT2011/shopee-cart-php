<?php  
session_start();
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

					<h3>Recent Orders</h3>
					<br>
					<table class="cart-table account-table table table-bordered">
						<thead>
							<tr>
								<th>Order</th>
								<th>Date</th>
								<th>Status</th>
								<th>Total</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php  
								$sql = "SELECT * FROM orders WHERE uid=$uid";
								$res = mysqli_query($conn, $sql);

								while ($r=mysqli_fetch_assoc($res)) {
									$oisql = "SELECT COUNT(*) AS count FROM orderitems WHERE orderid={$r['id']}";
									$cntitem = mysqli_query($conn, $oisql);
									$cntitemres = mysqli_fetch_assoc($cntitem);
							?>
								<tr>
									<td><?php echo $r['id']; ?></td>
									<td><?php echo $r['timestamp']; ?></td>
									<td><?php echo $r['orderstatus']; ?></td>
									<td>&pound;<?php echo $r['totalprice']; ?> for <?php echo $cntitemres['count']; ?> items</td>
									<td>
										<a href="view-order.php?id=<?php echo $r['id']; ?>">View</a>
										<?php if ($r['orderstatus'] != 'Cancelled' && $r['orderstatus'] != 'Delivered') {
											# code...
										?>
											|
											<a href="cancel-order.php?id=<?php echo $r['id']; ?>">Cancel</a>
										<?php } ?>

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
								<h4>Billing Address <a href="edit-address.php">Edit</a></h4>
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
