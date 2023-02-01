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
						<th>Customer Name</th>
						<th>Total Price</th>
						<th>Order Status</th>
						<th>Payment Mode</th>
						<th>Order Placed On</th>
						<th>Operations</th>
					</tr>
				</thead>
				<tbody>
					<?php  
					$sql = "SELECT * FROM orders AS o
								INNER JOIN (SELECT uid, CONCAT(firstname,' ', lastname) AS fullname FROM usersmeta) AS um
								ON um.uid = o.uid
								ORDER BY o.id DESC";
					$res = mysqli_query($conn, $sql);

					while ($r = mysqli_fetch_assoc($res)) {
						?>
						<tr>
							<td scope="row"><?php echo $r['id']; ?></td>
							<td><?php echo $r['fullname']; ?></td>
							<td><?php echo $r['totalprice']; ?></td>
							<td><?php echo $r['orderstatus']; ?></td>
							<td><?php echo $r['paymentnode']; ?></td>
							<td><?php echo $r['timestamp']; ?></td>
							<td><a href="order-process.php?id=<?php echo $r['id']; ?>">Process Order</a></td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<?php require('inc/footer.php'); ?>