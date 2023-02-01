<?php  
session_start();
require_once "../config/connect.php";

if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
	header('location: login.php');
}

if(isset($_GET) && !empty($_GET)){
	$id = $_GET['id'];
} else{
	header('location: products.php');
}


if (isset($_POST) && !empty($_POST)) {
	$namepd = mysqli_real_escape_string($conn, $_POST['productname']);
	$des = mysqli_real_escape_string($conn, $_POST['productdescription']);
	$catId = mysqli_real_escape_string($conn, $_POST['productcategory']);
	$price = mysqli_real_escape_string($conn, $_POST['productprice']);

	$pathimg = mysqli_real_escape_string($conn, $_POST['pathimg']);

	if(isset($_FILES) & !empty($_FILES)){
		$name = $_FILES['productimage']['name'];
		$size = $_FILES['productimage']['size'];
		$type = $_FILES['productimage']['type'];
		$tmp_name = $_FILES['productimage']['tmp_name'];

		$max_size = 10000000;
		$extension = substr($name, strpos($name, '.') + 1);

		if(isset($name) && !empty($name)){
			if(($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $size<=$max_size){
				$location = "uploads/";
				if(move_uploaded_file($tmp_name, $location.$name)){
					$pathimg = $location.$name;
					$smsg = "Uploaded Successfully";
				}else{
					$fmsg = "Failed to Upload File";
				}
			}else{
				$fmsg = "Only JPG files are allowed and should be less that 1MB";
			}
		}else{
			$fmsg = "Please Select a File";
		}
	}
	

	$sql = "UPDATE products SET name = '$namepd', description='$des', catid='$catId', price=$price, thumb='$pathimg' WHERE id=$id";

	$res = mysqli_query($conn, $sql);
	if($res){
		$smsg = "Product Updated";
	}else{
		$fmsg =  "Failed to Updated Product";
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
			<?php  
				$sql = "SELECT * FROM products WHERE id=$id";
				$res = mysqli_query($conn, $sql);
				$r = mysqli_fetch_assoc($res); 
			?>
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="ProdcutName">Product Name</label>
					<input type="text" class="form-control" name="productname" value="<?php echo $r['name']; ?>" id="productname" placeholder="Product Name">
				</div>

				<div class="form-group">
					<label for="productdescription">Product Description</label>
					<textarea class="form-control" name="productdescription" id="productdescription" rows="3" placeholder="Product Description"><?php echo $r['description']; ?></textarea>
				</div>

				<div class="form-group">
					<label for="productcategory">Product Category</label>
					<select class="form-control" name="productcategory" id="productcategory" placeholder="Product Category">
						<?php  
							$sqlCat = "SELECT * FROM category";
							$resCat = mysqli_query($conn, $sqlCat);
							while ($rCat = mysqli_fetch_assoc($resCat)) {
								# code...
						?>
							<option value="<?php echo $rCat['id']; ?>" <?php if($rCat['id'] == $r['catid']){echo 'selected';} ?> ><?php echo $rCat['name']; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group">
					<label for="productprice">Product Price</label>
					<input type="number" class="form-control" value="<?php echo $r['price']; ?>" name="productprice" id="productprice" placeholder="Product Price">
				</div>

				<div class="form-group">
					<label for="productimage">Product Image</label>
					<input type="hidden" name="pathimg" value="<?php if(!empty($r['thumb'])){ echo $r['thumb']; } else {echo '';}?>">
					<?php  
						if (isset($r['thumb']) && !empty($r['thumb'])) {
					?>
						<br>
						<img style="width: 100px; height: 100px" src="<?php echo $r['thumb']; ?>">
						<a href="delproimg.php?id=<?php echo $r['id']; ?>">Delete Image</a>
					<?php } else { ?>
						<input type="file" name="productimage" id="productimage" placeholder="Product Image">
						<p class="help-block">Only jpg/png are allowed.</p>
					<?php } ?>
					
				</div>

				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>
</section>
<?php require('inc/footer.php'); ?>

