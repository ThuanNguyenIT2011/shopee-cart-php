<?php  
session_start();
require_once "../config/connect.php";

if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
	header('location: login.php');
}

$categories = [];
$sqlcat = "SELECT * FROM category";
$res = mysqli_query($conn, $sqlcat);

while ($rcat = mysqli_fetch_assoc($res)) {
	$categories[$rcat['id']] = $rcat['name'];
}

?>

<?php require('inc/header.php'); ?>
<?php require('inc/nav.php'); ?>
			
	<!-- <div class="close-btn fa fa-times"></div> -->

<section id="content">
	<div class="content-blog">
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Product Name</th>
						<th>Category Name</th>
						<th>Thumbnail</th>
						<th>Operations</th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$sql = "SELECT * FROM products";
						$res = mysqli_query($conn, $sql);

						while ($r = mysqli_fetch_assoc($res)) {
						
					?>
						<tr>
							<td scope="row"><?php echo $r['id']; ?></td>
							<td><?php echo $r['name']; ?></td>
							<td><?php echo $categories[$r['catid']]; ?></td>
							<td><?php if(empty($r['thumb'])) {echo 'No'; } else { echo 'Yes';} ?></td>
							<td><a href="editProduct.php?id=<?php echo $r['id']; ?>">Edit</a> | <a href="delProduct.php?id=<?php echo $r['id']; ?>">Delete</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
	
<?php require('inc/footer.php'); ?>