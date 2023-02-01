<?php 
session_start();
require_once 'config/connect.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = (int)$_GET['id'];
	$sql = "SELECT pro.*, cat.name AS catname FROM 
	(SELECT * FROM products WHERE id=$id) AS pro
	INNER JOIN category as cat
	ON cat.id = pro.catid";
	$res = mysqli_query($conn, $sql);


	if (mysqli_num_rows($res) != 1) {
		header('location: index.php');
	}

	$product = mysqli_fetch_assoc($res);
} else {
	header('location: index.php');
}


if (isset($_SESSION['customerid']) && !empty($_SESSION['customerid']) && isset($_POST) && !empty($_POST)) {
	$uid = $_SESSION['customerid'];
	$review = filter_var($_POST['review'], FILTER_SANITIZE_STRING);
	$datetimnow = date("Y-m-d H:i:s");
	$isql = "INSERT INTO reviews(pid, uid, review, timestamp) VALUES($id, $uid, '$review', '$datetimnow')";
	$ires = mysqli_query($conn, $isql);
	if ($ires) {
		header("location: single.php?id=$id");
	}
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
					<h2>Shop</h2>
					<p>Get the best kit for smooth shave</p>
				</div>

				
				<div class="col-md-10 col-md-offset-1">

					<div class="row">
						<div class="col-md-5">
							<div class="gal-wrap">
								<div id="gal-slider" class="flexslider">
									<ul class="slides">
										<li><img src="admin/<?php echo $product['thumb']; ?>" class="img-responsive" alt=""/></li>
									</ul>
								</div>
								<ul class="gal-nav">
									<li>
										<div>
											<img src="admin/<?php echo $product['thumb']; ?>" class="img-responsive" alt=""/>
										</div>
									</li>
								</ul>
								<div class="clearfix"></div>

							</div>
						</div>
						<div class="col-md-7 product-single">
							<h2 class="product-single-title no-margin"><?php echo $product['name']; ?></h2>
							<div class="space10"></div>
							<div class="p-price">INR $<?php echo $product['price']; ?></div>
							<p><?php echo $product['description']; ?></p>
							<form action="addtocart.php" method="GET">
								<div class="product-quantity">
									<span>Quantity:</span> 
									<input name="id" type="hidden" value="<?php echo $product['id']; ?>">
									<input name="quant" type="text" value="1" placeholder="1">

								</div>
								<div class="shop-btn-wrap">
									<input type="submit" href="#" class="button btn-small" value="Add to Cart">
								</div>
							</form>
							<a href="addtowishlist.php?id=<?php echo $id; ?>">Add To WishList</a>
							<div class="product-meta">
								<span>Categories: <a href="index.php?id=<?php echo $product['catid']; ?>"><?php echo $product['catname']; ?></a></span><br>
								<!-- <span>Tags: <a href="#">point</a>, <a href="#">size</a>, <a href="#">bike</a>, <a href="#">bag</a>, <a href="#">black</a>, <a href="#">darck</a>, <a href="#">sport</a>, <a href="#">ewuipment</a></span> -->
							</div>
						</div>
					</div>
					<div class="clearfix space30"></div>
					<div class="tab-style3">
						<!-- Nav Tabs -->
						<div class="align-center mb-40 mb-xs-30">
							<ul class="nav nav-tabs tpl-minimal-tabs animate">
								<li class="active col-md-6">
									<a aria-expanded="true" href="#mini-one" data-toggle="tab">Overview</a>
								</li>
								<!-- <li class="col-md-4">
									<a aria-expanded="false" href="#mini-two" data-toggle="tab">Product Info</a>
								</li> -->
								<li class="col-md-6">
									<a aria-expanded="false" href="#mini-three" data-toggle="tab">Reviews</a>
								</li>
							</ul>
						</div>
						<!-- End Nav Tabs -->
						<!-- Tab panes -->
						<div style="height: auto;" class="tab-content tpl-minimal-tabs-cont align-center section-text">
							<div style="" class="tab-pane fade active in" id="mini-one">
								<p><?php echo $product['description']; ?></p>
								<!-- <table class="table tba2">
									<tbody>
										<tr>
											<td>Sizes</td>
											<td>M, L, XL, XXL</td>
										</tr>
										<tr>
											<td>Prodused in</td>
											<td>USA</td>
										</tr>
										<tr>
											<td>Material</td>
											<td>plastic, textile</td>
										</tr>
									</tbody>
								</table> -->
							</div>
							<!-- <div style="" class="tab-pane fade" id="mini-two">
								<table class="table tba2">
									<tbody>
										<tr>
											<td>Sizes</td>
											<td>M, L, XL, XXL</td>
										</tr>
										<tr>
											<td>Prodused in</td>
											<td>USA</td>
										</tr>
										<tr>
											<td>Material</td>
											<td>plastic, textile</td>
										</tr>
										<tr>
											<td>Colors</td>
											<td>red, black, grey</td>
										</tr>
										<tr>
											<td>Dimension</td>
											<td>20x40x33</td>
										</tr>
										<tr>
											<td>Type</td>
											<td>bag</td>
										</tr>
										<tr>
											<td>Weight</td>
											<td>0.35kg</td>
										</tr>
									</tbody>
								</table>
							</div> -->
							<div style="" class="tab-pane fade" id="mini-three">
								<div class="col-md-12">
									<?php  
										$resql = "SELECT * FROM
													(SELECT * FROM reviews WHERE pid =$id) AS r
													INNER JOIN users
													ON users.id = r.uid
													INNER JOIN (SELECT uid AS userid,  CONCAT(firstname, ' ', lastname) AS fullname FROM usersmeta) AS u
													ON r.uid = u.userid";
										$reres = mysqli_query($conn, $resql);
									?>
									<h4 class="uppercase space35"><?php echo mysqli_num_rows($reres); ?> Reviews for Shaving Knives</h4>
									<ul class="comment-list">
										<?php  
										$reres = mysqli_query($conn, $resql);
										while ($re = mysqli_fetch_assoc($reres)) {

											?>
											<li>
												<a class="pull-left" href="#"><img class="comment-avatar" src="https://i.pinimg.com/736x/ed/80/f7/ed80f704afb25270ea9dac456da6407a.jpg" alt="" height="50" width="50"></a>
												<div class="comment-meta">
													<a href="#"><?php echo $re['fullname']; ?></a>
													<span>
														<em><?php echo $re['timestamp']; ?></em>
													</span>
												</div>
												<div class="rating2">
													<span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
												</div>
												<p>
													<?php echo $re['review']; ?>
												</p>
											</li>
										<?php } ?>
									</ul>
									<?php if(isset($_SESSION['customerid']) && !empty($_SESSION['customerid'])){ ?>
									<h4 class="uppercase space20">Add a review</h4>
										<form id="form" action="#" method="POST" class="review-form">
											<?php
												$uid = $_SESSION['customerid'];
												$usql = "SELECT * FROM 
															(SELECT id AS userid, email FROM users WHERE id=$id) AS u
															INNER JOIN (SELECT id, uid, CONCAT(firstname, ' ', lastname) AS fullname FROM usersmeta) AS umeta
															ON u.userid=umeta.uid";
												// echo $usql.'<br>';
												// die();
												$ures = mysqli_query($conn, $usql);
												while ($r = mysqli_fetch_assoc($ures)) {
											?>
												<div class="row">
													<div class="col-md-6 space20">
														<input name="name" class="input-md form-control" placeholder="Name *" maxlength="100" required="" type="text" readonly="true" value="<?php echo $r['fullname']; ?>">
													</div>
													<div class="col-md-6 space20">
														<input name="email" class="input-md form-control" placeholder="Email *" maxlength="100" required="" readonly="true" value="<?php echo $r['email']; ?>" type="email">
													</div>
												</div>
											<?php } ?>
											<!-- <div class="space20">
												<span>Your Ratings</span>
												<div class="clearfix"></div>
												<div class="rating3">
													<span>&#9734;</span><span>&#9734;</span><span>&#9734;</span><span>&#9734;</span><span>&#9734;</span>
												</div>
												<div class="clearfix space20"></div>
											</div> -->
											<div class="space20">
												<textarea name="review" id="text" class="input-md form-control" rows="6" placeholder="Add review.." maxlength="400"></textarea>
											</div>
											<button name="sm-review" type="submit" class="button btn-small">
												Submit Review
											</button>
										</form>
									</div>
								<?php } ?>
								<div class="clearfix space30"></div>
							</div>
						</div>
					</div>
					<div class="space30"></div>
					<div class="related-products">
						<h4 class="heading">Related Products</h4>
						<hr>
						<div class="row">
							<div id="shop-mason" class="shop-mason-3col">
								<?php  
								$relsql = "SELECT * FROM products WHERE catid={$product['catid']} AND id!={$id} LIMIT 3";
								// $relsql = "SELECT * FROM products ORDER BY rand() LIMIT 3";

								$relres = mysqli_query($conn, $relsql);
								while ($relr = mysqli_fetch_assoc($relres)) {
									?>
									<div class="sm-item isotope-item">
										<div class="product">
											<div class="product-thumb">
												<img src="admin/<?php echo $relr['thumb']; ?>" class="img-responsive" alt="">
												<div class="product-overlay">
													<span>
														<a href="single.php?id=<?php echo $relr['id']; ?>" class="fa fa-link"></a>
														<a href="addtocart.php?id=<?php echo $relr['id']; ?>" class="fa fa-shopping-cart"></a>
													</span>					
												</div>
											</div>
											<div class="rating">
												<span class="fa fa-star act"></span>
												<span class="fa fa-star act"></span>
												<span class="fa fa-star act"></span>
												<span class="fa fa-star act"></span>
												<span class="fa fa-star act"></span>
											</div>
											<h2 class="product-title"><a href="#"><?php echo $relr['name']; ?></a></h2>
											<div class="product-price">INR $<?php echo $relr['price']; ?></div>
										</div>
									</div>
								<?php } ?>
							</div>

						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>

<div class="clearfix space70"></div>
<!-- FOOTER -->

<?php require('inc/footer.php'); ?>