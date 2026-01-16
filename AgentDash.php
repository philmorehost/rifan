<?php
	include_once("fconfig.php");
	if(!isset($_SESSION["agent"])){
		header("Location: agent-log-25.php");
	}
	
	// Get total farmers for the agent's LGA
	$agent_lga = $_SESSION["agent_lga"];
	$total_farmers_result = mysqli_query($db_conn, "SELECT COUNT(*) as total FROM " . $db_json["farmer_table"] . " WHERE lga = '$agent_lga'");
	$total_farmers = mysqli_fetch_assoc($total_farmers_result)['total'];
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

<div class="container mt-5">
	<div class="text-center mb-5">
		<h3>WELCOME BACK, AGENT</h3>
		<p class="text-muted">Agent Code: <?php echo strtoupper($_SESSION["agent_lga"]."-".$_SESSION["agent"]); ?></p>
	</div>

	<div class="row justify-content-center g-3 mb-5">
		<div class="col-md-4">
			<div class="card text-white bg-success">
				<div class="card-body text-center">
					<h5 class="card-title">Total Farmers</h5>
					<p class="card-text fs-4"><?php echo $total_farmers; ?></p>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12">
		<div class="row g-2">
			<div class="col-md-6 d-grid">
				<a class="btn btn-secondary p-3" href="CreateFarmer.php">Create Farmer</a>
			</div>
			<div class="col-md-6 d-grid">
				<a class="btn btn-secondary p-3" href="ViewFarmer.php">View Farmer</a>
			</div>
			<div class="col-md-6 d-grid">
				<a class="btn btn-secondary p-3" href="EditFarmer.php">Edit Farmer</a>
			</div>
			<div class="col-md-6 d-grid">
				<a class="btn btn-secondary p-3" href="ViewLga.php">View LGA</a>
			</div>
		</div>
	</div>
</div>

</body>
</html>
