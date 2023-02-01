<?php  
session_start();
if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
	header('location: login.php');
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
						<h2>Admin Shop</h2>
						<p>admin</p>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<div class="clearfix space70"></div>
	
<?php require('inc/footer.php'); ?>