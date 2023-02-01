<?php
require_once 'config/connect.php';

if(!isset($_SESSION)) { 
	session_start(); 
}

$carts = [];
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
	$carts = $_SESSION['cart'];
}

?>
<?php require('inc/header.php'); ?>
<?php require('inc/nav.php'); ?>

<div class="close-btn fa fa-times"></div>

<!-- SHOP CONTENT -->
<section id="content">
	<div class="content-blog">
		<div class="container">
			<div class="row">
				<div class="page_header text-center">
					<h2>Shop Cart</h2>
					<p>Get the best kit for smooth shave</p>
				</div>
				<div class="col-md-12">

					<table class="cart-table table table-bordered">
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
							$total = 0;
							foreach ($carts as $key => $value) {
								$cartsql = "SELECT * FROM products WHERE id={$key}";
								$cartres = mysqli_query($conn, $cartsql);
								$pro = mysqli_fetch_assoc($cartres);
								
								?>
								<tr>
									<td>
										<a class="remove" href="delcart.php?id=<?php echo $key; ?>"><i class="fa fa-times"></i></a>
									</td>
									<td>
										<a href="#"><img src="admin/<?php echo $pro['thumb']; ?>" alt="" height="90" width="90"></a>					
									</td>
									<td>
										<a href="single.php?id=<?php echo $key; ?>">
											<?php
											$namepro = $pro['name']; 
											$lenlimit = min(strlen($namepro), 30);

											$namepro = substr($namepro, 0, $lenlimit);
											echo $namepro; 
											?>
										</a>					
									</td>
									<td>
										<span class="amount">£<?php echo $pro['price']; ?></span>
									</td>
									<td>
										<div class="quantity"><?php echo $carts[$key]['quant']; ?></div>
									</td>
									<td>
										<span class="amount">£ <?php echo $carts[$key]['quant'] * $pro['price']; ?></span>					
									</td>
								</tr>
								<?php
								$total +=  $carts[$key]['quant'] * $pro['price'];
							} 
							?>
							<tr>
								<td colspan="6" class="actions">
									<div class="col-md-6">
										<div class="coupon">
											<label>Coupon:</label><br>
											<input placeholder="Coupon code" type="text"> <button type="submit">Apply</button>
										</div>
									</div>
									<div class="col-md-6">
										<div class="cart-btn">
											<!-- <button class="button btn-md" type="submit">Update Cart</button> -->
											<a href="checkout.php" class="button btn-md" type="submit">Checkout</a>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>		

					<div class="cart_totals">
						<div class="col-md-6 push-md-6 no-padding">
							<h4 class="heading">Cart Totals</h4>
							<table class="table table-bordered col-md-6">
								<tbody>
									<tr>
										<th>Cart Subtotal</th>
										<td><span class="amount">£ <?php echo $total; ?>.00</span></td>
									</tr>
									<tr>
										<th>Shipping and Handling</th>
										<td>
											Free Shipping				
										</td>
									</tr>
									<tr>
										<th>Order Total</th>
										<td><strong><span class="amount">£<?php echo $total; ?>.00</span></strong> </td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>			

				</div>
			</div>
		</div>
	</div>
</section>

<div class="clearfix space70"></div>
<!-- FOOTER -->
<footer id="footer2">

	<div class="footer-bottom container">
		<div class="row">
			<div class="col-md-6">
				<p>&copy; Copyright 2015. CodingCyber</p>
			</div>
			<div class="col-md-6">

			</div>
		</div>
	</div>
</footer>
<!-- FOOTER -->

<?php require('inc/footer.php'); ?>
