<?php
	include_once("fconfig.php");
	if(isset($_SESSION["admin"])){
		header("Location: AdminDash.php");
	}
	
	$msg = "";
	if(isset($_POST["login"])){
		$email = mysqli_real_escape_string($db_conn, $_POST["email"]);
		
		if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
			$select_admin = mysqli_query($db_conn, "SELECT * FROM ".$db_json["admin_table"]." WHERE email='".$email."'");
			if(mysqli_num_rows($select_admin) == 1){
				$_SESSION["admin"] = $email;
				header("Location: AdminDash.php");
			}else{
				$msg = '<div class="p-2 bg-danger text-white rounded-1">Account not registered with us!</div>';
			}
		}else{
			$msg = '<div class="p-5 bg-danger text-white">Enter Email!</div>';
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>RIFAN | ADMIN LOGIN</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style type="text/css">
	
	input::file-selector-button {
		display: none;
	}

</style>
</head>
<body>

<center>
<div id="container" class="col-10">
	<img class="col-3 col-lg-2 mt-5"
		src="static/rifan.jpg"><br>
	
	<h1 class="display-6 mt-5">FARMER ADMIN LOGIN</h1>
	<?php echo $msg; ?>
	<form method="post" enctype="multipart/form-data">
	
	<div class="input-group mb-3 mt-3">
		<div class="input-group-prepend">
			<span class="input-group-text">Email address</span>
		</div>
		<input id="email" name="email" type="email" class="form-control" required>
	</div>
	
	<input type="submit" name="login" value="LOGIN" onclick="Authentication(this);" class="btn btn-secondary col-12">
	</form>
	
</div>
</center>

<script>

	/*function Authentication(element){
		element.value = "Authenticating...";
		return true;
	}*/
	
</script>


</body>
</html>