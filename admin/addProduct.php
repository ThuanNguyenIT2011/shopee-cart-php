<?php  
session_start();
require_once "../config/connect.php";

if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
	header('location: login.php');
}

if (isset($_POST) && !empty($_POST)) {
	$namepd = mysqli_real_escape_string($conn, $_POST['productname']);
	$des = mysqli_real_escape_string($conn, $_POST['productdescription']);
	$catId = mysqli_real_escape_string($conn, $_POST['productcategory']);
	$price = mysqli_real_escape_string($conn, $_POST['productprice']);
	
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
					$sql = "INSERT INTO products (name, description, catid, price, thumb) VALUES ('$namepd', '$des', '$catId', '$price', '$location$name')";
					$res = mysqli_query($conn, $sql);
					if($res){
						header('location: products.php');
					}else{
						$fmsg = "Failed to Create Product";
					}
				}else{
					$fmsg = "Failed to Upload File";
				}
			}else{
				$fmsg = "Only JPG files are allowed and should be less that 1MB";
			}
		}else{
			$fmsg = "Please Select a File";
		}
	}else{

		$sql = "INSERT INTO products (name, description, catid, price) VALUES ('$namepd', '$des', '$catId', '$price')";
		$res = mysqli_query($conn, $sql);
		if($res){
			header('location: products.php');
		}else{
			$fmsg =  "Failed to Create Product";
		}
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
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="ProdcutName">Product Name</label>
					<input type="text" class="form-control" name="productname" id="productname" placeholder="Product Name">
				</div>

				<div class="form-group">
					<label for="productdescription">Product Description</label>
					<textarea class="form-control" name="productdescription" id="productdescription" rows="3" placeholder="Product Description"></textarea>
				</div>

				<div class="form-group">
					<label for="productcategory">Product Category</label>
					<select class="form-control" name="productcategory" id="productcategory" placeholder="Product Category">
						<option value="">---SELECT CATEGORY--</option>
						<?php  
						$sql = "SELECT * FROM category";
						$res = mysqli_query($conn, $sql);
						while ($r = mysqli_fetch_assoc($res)) {
							?>
							<option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group">
					<label for="productprice">Product Price</label>
					<input type="number" class="form-control" name="productprice" id="productprice" placeholder="Product Price">
				</div>

				<div class="form-group">
					<label for="productimage">Product Image</label>
					<input type="file" name="productimage" id="productimage" placeholder="Product Image">
					<p class="help-block">Only jpg/png are allowed.</p>
				</div>

				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>
</section>
<?php require('inc/footer.php'); ?>
