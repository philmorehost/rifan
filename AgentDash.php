<?php
	include_once("fconfig.php");
	if(!isset($_SESSION["agent"])){
		header("Location: agent-log-25.php");
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>RIFAN | Agent Dashboard</title>
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
	
	<span style="display: block; line-height: 10px;" class="mt-5 mb-5"><h3>WELCOME BACK, AGENT</h3> <br/> Agent Code: <?php echo strtoupper($_SESSION["agent_lga"]."-".$_SESSION["agent"]); ?></span>
	
	<div class="col-12">
		
		<div class="row gap-2 my-2">
			<button type="button" class="btn btn-secondary col p-3"><a class="nav-link" href="CreateFarmer.php">Create Farmer</a></button>
			<button type="button" class="btn btn-secondary col p-3"><a class="nav-link" href="ViewFarmer.php">View Farmer</a></button>
		</div>
		
		
		<div class="row gap-2 my-2">
			<button type="button" class="btn btn-secondary col p-3"><a class="nav-link" href="EditFarmer.php">Edit Farmer</a></button>
			<button type="button" class="btn btn-secondary col p-3"><a class="nav-link" href="ViewLga.php">View LGA</a></button>
		</div>
		
		
	</div>
</div>
</center>



</body>
</html>