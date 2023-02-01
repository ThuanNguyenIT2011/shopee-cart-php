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

<div class="menu-wrap">
	<div id="mobnav-btn">Menu <i class="fa fa-bars"></i></div>
	<ul class="sf-menu">
		<li>
			<a href="index.php">Home</a>
		</li>
		<li>
			<a href="#">Shop</a>
			<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
			<ul>
				<?php  
				$sqlcat = "SELECT * FROM category";
				$res = mysqli_query($conn, $sqlcat);

				while ($rcat = mysqli_fetch_assoc($res)) {
					?>
					<li><a href="index.php?id=<?php echo $rcat['id']; ?>"><?php echo $rcat['name']; ?></a></li>
				<?php } ?>
			</ul>
		</li>
		<li>
			<a href="#">My Account</a>
			<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
			<ul>
				<li><a href="my-account.php">My Orders</a></li>
				<li><a href="wishlist.php">My WishList</a></li>
				<li><a href="edit-address.php">Edit Address</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Contact</a>
		</li>
	</ul>
	<div class="header-xtra">
		<div class="s-cart">
			<div class="sc-ico"><i class="fa fa-shopping-cart"></i><em><?php echo count($carts) ?></em></div>

			<div class="cart-info">
				<small>You have <em class="highlight"><?php echo count($carts) ?> item(s)</em> in your shopping bag</small>
				<br>
				<br>
				<?php
				$total = 0; 
				foreach ($carts as $key => $value) {
					$cartsql = "SELECT * FROM products WHERE id={$key}";
					$cartres = mysqli_query($conn, $cartsql);
					$pro = mysqli_fetch_assoc($cartres);
					?>
					<div class="ci-item">
						<img src="admin/<?php echo $pro['thumb']; ?>" width="70" alt=""/>
						<div class="ci-item-info">
							<h5><a href="single.php?id=<?php echo $key; ?>">
								<?php  
								$namepro = $pro['name'];
								$lenlimit = min(strlen($namepro), 20);
								$namepro = substr($namepro, 0, $lenlimit);
								echo $namepro.'...';
								?>
							</a></h5>
							<p><?php echo $value['quant']; ?> x $<?php echo $pro['price']; ?>.00</p>
							<div class="ci-edit">
								<!-- <a href="#" class="edit fa fa-edit"></a> -->
								<a href="delcart.php?id=<?php echo $key; ?>" class="edit fa fa-trash"></a>
							</div>
						</div>
					</div>
					<?php 
					$total += $pro['price'] * $value['quant'];
				} 
				?>
				<div class="ci-total">Subtotal: $<?php echo $total; ?>.00</div>
				<div class="cart-btn">
					<a href="cart.php">View Bag</a>
					<a href="checkout.php">Checkout</a>
				</div>
			</div>
		</div>
		<div class="s-search">
			<div class="ss-ico"><i class="fa fa-search"></i></div>
			<div class="search-block">
				<div class="ssc-inner">
					<form>
						<input type="text" placeholder="Type Search text here...">
						<button type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</header>