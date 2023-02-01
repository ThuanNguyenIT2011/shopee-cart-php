<?php  
session_start();
require_once '../config/connect.php';
if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
	header('location: login.php');
}

if(isset($_GET) && !empty($_GET)){
	$id = (int)$_GET['id'];

	$sql = "SELECT * FROM category WHERE id=$id";
	$res = mysqli_query($conn, $sql);
	$r = mysqli_fetch_assoc($res);

	if (empty($r)) {
		header('location: categories.php');
	}
} else{
	header('location: categories.php');
}

if (isset($_POST) && !empty($_POST)) {
	$name = mysqli_real_escape_string($conn, $_POST['categoryname']);
	$id = mysqli_real_escape_string($conn, $_POST['id']);

	$sql = "UPDATE category SET name = '$name' WHERE id=$id";
	$res = mysqli_query($conn, $sql);

	if ($res) {
		// echo "Category Updated";
		$smsg = "Category Updated";
	} else{
		// echo "Failed Update Category";
		$fmsg = "Failed Update Category";
	}
} 
?>

<?php require('inc/header.php'); ?>
<?php require('inc/nav.php'); ?>

<section id="content">
	<div class="content-blog">
		<div class="container">
			<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
			<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
			<form method="post">
				<div class="form-group">
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					<label for="Productname">Category Name</label>
					<?php  
					$sql = "SELECT * FROM category WHERE id=$id";
					$res = mysqli_query($conn, $sql);
					$r = mysqli_fetch_assoc($res);

					if (empty($r)) {
						header('location: categories.php');
					}
					?>
					<input type="text" class="form-control" name="categoryname" 1d="Categoryname"
					placeholder="Category Name" value="<?php echo $r['name']; ?>">
				</div>
				<button type="submit" class="btn btn-default">Update</button>
			</form>
		</div>
	</div>
</section>
<?php require('inc/footer.php'); ?>