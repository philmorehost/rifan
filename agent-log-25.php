<?php
include_once("fconfig.php");

$msg = "";
if (isset($_POST["login"])) {
	$agent_id = mysqli_real_escape_string($db_conn, $_POST["id"]);
	$exp_agent_id = array_filter(explode("-", trim($agent_id)));
	$agent_code = trim($exp_agent_id[1]);
	$agent_lga = trim($exp_agent_id[0]);

	if (!empty($agent_code) && !empty($agent_lga)) {
		$select_agents = mysqli_query($db_conn, "SELECT * FROM " . $db_json["agent_table"] . " WHERE code = '$agent_code' AND lga = '$agent_lga'");
		if (mysqli_num_rows($select_agents) == 1) {
			$get_agent = mysqli_fetch_array($select_agents);
			$_SESSION["agent"] = $get_agent["code"];
			$_SESSION["agent_lga"] = $get_agent["lga"];

			header("Location: AgentDash.php");
		} else {
			$msg = '<div class="p-2 bg-danger text-white rounded-1">Account not registered with us!</div>';
		}
	} else {
		$msg = '<div class="p-5 bg-danger text-white">Enter Email!</div>';
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RIFAN | Agent Login</title>
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
			<img class="col-3 col-lg-2 mt-5" src="static/rifan.jpg"><br>

			<h1 class="display-6 mt-5">FARMER AGENT LOGIN</h1>

			<form method="post" enctype="multipart/form-data">

				<div class="input-group mb-3 mt-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Agent Code</span>
					</div>
					<input id="" type="text" name="id" class="form-control" required>
				</div>

				<input type="submit" value="LOGIN" name="login" class="btn btn-secondary col-12">
			</form>

		</div>
	</center>



</body>

</html>