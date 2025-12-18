<?php
	include_once("fconfig.php");
	if(!isset($_SESSION["admin"]) && !isset($_SESSION["agent"])){
		header("Location: index.php");
	}
	
	$msg = "";
	if(isset($_POST["create"])){
		$name = mysqli_real_escape_string($db_conn, $_POST["name"]);
		$email = mysqli_real_escape_string($db_conn, $_POST["email"]);
		$phone = mysqli_real_escape_string($db_conn, $_POST["phone"]);
		$nin = mysqli_real_escape_string($db_conn, $_POST["nin"]);
		$bvn = mysqli_real_escape_string($db_conn, $_POST["bvn"]);
		$farm_location = mysqli_real_escape_string($db_conn, $_POST["farm-location"]);
		$address = mysqli_real_escape_string($db_conn, $_POST["address"]);
		$lga = mysqli_real_escape_string($db_conn, $_POST["lga"]);
		$photo = $_FILES["photo"]["name"];
		$photo_tmp = $_FILES["photo"]["tmp_name"];
		
		if(!empty($name)
		&& !empty($email)
		&& filter_var($email, FILTER_VALIDATE_EMAIL)
		&& !empty($phone)
		&& strlen($phone) == 11
		&& !empty($nin)
		&& strlen($nin) == 11
		&& !empty($bvn)
		&& strlen($bvn) == 11
		&& !empty($farm_location)
		&& !empty($address)
		&& !empty($lga)
		&& !empty($photo)){
			$farmer_code = strtolower(substr(str_shuffle("QWERTYUIOPASDFGHJKLZXCVBNM1234567890"), 0, 6));
			if(mysqli_num_rows(mysqli_query($db_conn, "SELECT * FROM ".$db_json["farmer_table"]." WHERE email='".$email."'")) == 0){
				move_uploaded_file($photo_tmp, "static/farmer/".$farmer_code.".jpg");
				mysqli_query($db_conn, "INSERT INTO ".$db_json["farmer_table"]." (code, fullname, email, phone, nin, bvn, farm_location, address, lga, photo) VALUES ('$farmer_code', '$name', '$email', '$phone', '$nin', '$bvn', '$farm_location', '$address', '$lga', '".$farmer_code.".jpg')");
				$msg = '<div class="p-2 bg-secondary text-white rounded-1">Registration successful, FARMER ID: '.strtoupper($lga).'-'.strtoupper($farmer_code).'</div>';
			}else{
				$msg = '<div class="p-2 bg-danger text-white rounded-1">Email choosen by another farmer!</div>';
			}
		}else{
			$msg = '<div class="p-2 bg-danger text-white rounded-1">Fill all required fields!</div>';
		}
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>RIFAN | Create Farmer</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="static/style.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style type="text/css">
	
	input::file-selector-button {
		display: none;
	}

</style>
</head>
<body>

<?php include_once("navbar.php"); ?>

<center>
<div id="container" class="col-10">
	
	<h1 class="fs-5 mt-5">FARMERS REGISTRATION FORM</h1>
	<?php echo $msg; ?>
	
	<form method="post" enctype="multipart/form-data">
	<div class="input-group input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">Fullname</span>
		</div>
		<input id="" type="text" name="name" class="form-control" required>
	</div>
	
	<div class="input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">Email address</span>
		</div>
		<input id="" type="email" name="email" class="form-control" required>
	</div>
	
	<div class="input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">Phone number</span>
		</div>
		<input id="" type="text" name="phone" pattern="[0-9]{11}" title="Phone number must be 11 digit" class="form-control" required>
	</div>
	
	<div class="input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">NIN number</span>
		</div>
		<input id="" type="text" name="nin" pattern="[0-9]{11}" title="NIN must be 11 digit" class="form-control" required>
	</div>

	<div class="alert alert-warning" role="alert">
		<strong>Security Notice:</strong> Farmers are strictly advised to be the one to compute their BVN numbers by themselves. The Admin and the Agents should not attempt to collect the BVN number for security reasons.
	</div>
	<div class="input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">BVN number</span>
		</div>
		<input id="" type="text" name="bvn" pattern="[0-9]{11}" title="BVN must be 11 digit" class="form-control" required>
	</div>
	
	<div class="input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">Farm Location</span>
		</div>
		<input id="" type="text" name="farm-location" class="form-control" required>
	</div>
	
	<div class="input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">Farmer's address</span>
		</div>
		<input id="" type="text" name="address" class="form-control" required>
	</div>
	
	<div class="input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">Farmer's LGA</span>
		</div>
		<select id="" name="lga" class="form-select" required>
			<option selected disabled>Select LGA</option>
			<?php
				$lga_json = json_decode(file_get_contents("lga.json"), true);
				foreach($lga_json as $key => $value){
					if(isset($_SESSION["agent"]) && !isset($_SESSION["admin"])){
						if($key == $_SESSION["agent_lga"]){
							$disabled = "disabled";
							$selected = "selected";
							echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
						}
					}else{
						echo '<option value="'.$key.'">'.$value.'</option>';
					}
				}
			?>
		</select>
	</div>
	
	<div class="input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">Upload Farmer's Picture</span>
		</div>
		<input id="" type="file" name="photo" class="form-control" required>
	</div>
	
	
	<input type="submit" value="CREATE FARMER" name="create" class="btn btn-secondary col-12">
	</form>
	
</div>
</center>



</body>
</html>