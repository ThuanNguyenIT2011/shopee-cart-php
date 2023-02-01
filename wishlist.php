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
					<h2>My Wish Product</h2>
				</div>
				<div class="col-md-12">

					<h3>Recent Orders</h3>
					<br>
					<table class="cart-table account-table table table-bordered">
						<thead>
							<tr>
								<th></th>
								<th>Thumb</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Added On</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php  
								$sql = "SELECT * FROM 
											(SELECT * FROM wishlist WHERE uid=$uid) AS w
											INNER JOIN (SELECT id AS proid, name, price, thumb FROM products) AS p
											ON p.proid=w.pid";
								$res = mysqli_query($conn, $sql);

								while ($r=mysqli_fetch_assoc($res)) {
							?>
								<tr>
									<td>
										<a class="remove" href="delitemwishlist.php?id=<?php echo $r['id']; ?>"><i class="fa fa-times"></i></a>
									</td>
									<td>
										<a href="#"><img src="admin/<?php echo $r['thumb']; ?>" alt="" height="90" width="90"></a>
									</td>
									<td>
										<a href="single.php?id=<?php echo $r['pid']; ?>">
											<?php
												$namepro = $r['name']; 
												$lenlimit = min(strlen($namepro), 30);

												$namepro = substr($namepro, 0, $lenlimit);
												echo $namepro.'...'; 
											?>
										</a>
											
									</td>
									<td>$ <?php echo $r['price']; ?>.00</td>
									<td><?php echo $r['timestamp']; ?></td>
									<td>
										<a href="addtocart.php?id=<?php echo $r['pid']; ?>">Add To Cart</a>
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
