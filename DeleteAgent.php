<?php
include_once("fconfig.php");
if (!isset($_SESSION["admin"])) {
	header("Location: admin-022225.php");
}

$msg = "";
$search_text = "";
$get_page_search = strip_tags($_GET["search"]);
if (!empty($get_page_search) && strlen($get_page_search) >= 1) {
	$search_text = strtoupper($get_page_search);
}

$exp_search_text = array_filter(explode("-", trim($search_text)));
$agent_code = trim($exp_search_text[1]);
$agent_lga = trim($exp_search_text[0]);
$select_agents = mysqli_query($db_conn, "SELECT * FROM " . $db_json["agent_table"] . " WHERE code = '$agent_code' AND lga = '$agent_lga'");
if (mysqli_num_rows($select_agents) == 1) {
	unlink("static/agent/".strtolower($agent_code).".jpg");
	mysqli_query($db_conn, "DELETE FROM " . $db_json["agent_table"] . " WHERE code = '$agent_code' AND lga = '$agent_lga'");
	$msg = '<div class="p-2 bg-secondary text-white rounded-1">Agent ('.strtoupper($agent_lga.'-'.$agent_code).') Removed successfully</div>';
} else {
	if (empty($search_text)) {
		$msg = '<div class="p-2 bg-danger text-white rounded-1">Fill all required fields!</div>';
	} else {
		$msg = '<div class="p-2 bg-danger text-white rounded-1">Agent not registered with us</div>';
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RIFAN | Delete Agent</title>
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
				<h1 class="fs-5 mt-5">DELETE AGENT ACCOUNT</h1>
				<?php echo $msg; ?>
				<form method="get">
					<div class="input-group input-group mb-3 mt-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Agent Code</span>
						</div>

						<input id="" type="text" name="search" value="<?php echo strtoupper($search_text); ?>"
							class="form-control" required>
						<div class="input-group-append">
							<button type="submit" name="" class="btn btn-secondary">Delete</button>
						</div>
					</div>
				</form>

		</div>
	</center>



</body>

</html>