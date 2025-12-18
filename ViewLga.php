<?php
include_once("fconfig.php");
if(!isset($_SESSION["admin"]) && !isset($_SESSION["agent"])){
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RIFAN | View LGA</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
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

			<h1 class="fs-5 mt-5 fw-bold">LGA AGENT/FARMER'S</h1>
			<?php echo $msg; ?>
			
			<div class="table-responsive mt-3">
				<table class="table table-striped table-bordered align-middle caption-top">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Code</th>
							<th scope="col">LGA</th>
							<th scope="col">Agents</th>
							<th scope="col">Farmers</th>
						</tr>

					</thead>
					<tbody>

						<?php
						
						if(!isset($_SESSION["admin"])) {
							$farmer_lga = $_SESSION["agent_lga"];
						}else{
							$farmer_lga = "";
						}
						
						$lga_json = json_decode(file_get_contents("lga.json"), true);
						foreach ($lga_json as $key => $value) {
							if (!empty($farmer_lga) && $key == $farmer_lga) {
								$select_agents = mysqli_query($db_conn, "SELECT * FROM " . $db_json["agent_table"] . " WHERE lga='" . $key . "'");
								$select_farmers = mysqli_query($db_conn, "SELECT * FROM " . $db_json["farmer_table"] . " WHERE lga='" . $key . "'");
								
								echo '<tr>
									<th scope="row"> ' . strtoupper($key) . ' </th>
									<td>' . $value . '</td>
									<td>' . mysqli_num_rows($select_agents) . '</td>
									<td>' . mysqli_num_rows($select_farmers) . '</td>
								</tr>';
							} else {
								if(isset($_SESSION["admin"])){
									$select_agents = mysqli_query($db_conn, "SELECT * FROM " . $db_json["agent_table"] . " WHERE lga='" . $key . "'");
									$select_farmers = mysqli_query($db_conn, "SELECT * FROM " . $db_json["farmer_table"] . " WHERE lga='" . $key . "'");
									
									echo '<tr>
									<th scope="row"> ' . strtoupper($key) . ' </th>
									<td>' . $value . '</td>
									<td>' . mysqli_num_rows($select_agents) . '</td>
									<td>' . mysqli_num_rows($select_farmers) . '</td>
									</tr>';
								}
							}
						}

						?>

					</tbody>
				</table>
			</div>

		</div>
	</center>



</body>

</html>