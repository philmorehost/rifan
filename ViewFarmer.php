<?php
include_once("fconfig.php");
if(!isset($_SESSION["admin"]) && !isset($_SESSION["agent"])){
	header("Location: index.php");
}
	

$msg = "";

$prev_page = 1;
$current_page = 1;
$next_page = 1;
$search_text = "";

$get_page_num = strip_tags($_GET["id"]);
if (is_numeric($get_page_num) && $get_page_num >= 1) {
	if ($get_page_num == 1) {
		$next_page = 2;
	} else {
		if ($get_page_num > 1) {
			$prev_page = ($get_page_num - 1);
			$current_page = $get_page_num;
			$next_page = ($get_page_num + 1);
		}
	}
} else {
	$next_page = 2;
}

$get_page_search = strip_tags($_GET["search"]);
if (!empty($get_page_search) && strlen($get_page_search) >= 1) {
	$search_text = $get_page_search;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RIFAN | View Farmer</title>
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

			<h1 class="fs-5 mt-5 fw-bold">FARMERS LIST</h1>
			<?php echo $msg; ?>
			<form method="get">
				<div id="container" class="col-10 col-lg-4">
					<div class="input-group input-group mb-3 mt-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Search</span>
						</div>

						<input hidden readonly id="" type="text" name="id" value="<?php echo $current_page; ?>"
							class="form-control" required>
						<input id="" type="text" name="search" value="<?php echo $search_text; ?>" class="form-control"
							required>
						<div class="input-group-append">
							<button type="submit" name="" class="btn btn-secondary">GO</button>
						</div>
					</div>
				</div>
			</form>
			<div class="table-responsive mt-3">
				<table class="table table-striped table-bordered align-middle caption-top">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Code</th>
							<th scope="col">Name</th>
							<th scope="col">Email</th>
							<th scope="col">Phone</th>
							<th scope="col">NIN</th>
							<th scope="col">LGA</th>
							<th scope="col">Farm Location</th>
							<th scope="col">Address</th>
							<th scope="col">Photo</th>
						</tr>

					</thead>
					<tbody>

						<?php
						
						if(!isset($_SESSION["admin"])) {
							$farmer_lga = $_SESSION["agent_lga"];
						}else{
							$farmer_lga = "";
						}
						
						$exp_search_text = array_filter(explode("-", trim($search_text)));
						
						if(empty($farmer_lga)){
						if (count($exp_search_text) > 1) {
							$search_statement = "";
							foreach ($exp_search_text as $value) {
								$search_statement .= "code LIKE '%$value%' OR ";
							}
							$search_statement = rtrim($search_statement, " OR ");
							$search_statement = $search_statement . " OR code LIKE '%$search_text%' OR fullname LIKE '%$search_text%' OR email LIKE '%$search_text%' OR phone LIKE '%$search_text%' OR nin LIKE '%$search_text%' OR lga LIKE '%$search_text%' OR farm_location LIKE '%$search_text%' OR address LIKE '%$search_text%'";
						} else {
							$search_statement = "code LIKE '%$search_text%' OR fullname LIKE '%$search_text%' OR email LIKE '%$search_text%' OR phone LIKE '%$search_text%' OR nin LIKE '%$search_text%' OR lga LIKE '%$search_text%' OR farm_location LIKE '%$search_text%' OR address LIKE '%$search_text%'";
						}
						}else{
						if (count($exp_search_text) > 1) {
							$search_statement = "";
							foreach ($exp_search_text as $value) {
								$search_statement .= "code LIKE '%$value%' OR ";
							}
							$search_statement = rtrim($search_statement, " OR ");
							$search_statement = "(".$search_statement . " OR code LIKE '%$search_text%' OR fullname LIKE '%$search_text%' OR email LIKE '%$search_text%' OR phone LIKE '%$search_text%' OR nin LIKE '%$search_text%' OR farm_location LIKE '%$search_text%' OR address LIKE '%$search_text%') AND lga='$farmer_lga'";
						} else {
							$search_statement = "(code LIKE '%$search_text%' OR fullname LIKE '%$search_text%' OR email LIKE '%$search_text%' OR phone LIKE '%$search_text%' OR nin LIKE '%$search_text%' OR farm_location LIKE '%$search_text%' OR address LIKE '%$search_text%') AND lga='$farmer_lga'";
						}
						}
						
						$select_farmers = mysqli_query($db_conn, "SELECT * FROM " . $db_json["farmer_table"] . " WHERE " . $search_statement . " ORDER BY date DESC LIMIT 20 OFFSET " . (($current_page - 1) * 20));
						if (mysqli_num_rows($select_farmers) >= 1) {
							while ($get_farmer = mysqli_fetch_array($select_farmers)) {
								echo 
										'<tr>
											<th scope="row"> ' . strtoupper(str_replace(" ", "", $get_farmer["lga"] . '-' . $get_farmer["code"])) . ' </th>
											<td>' . $get_farmer["fullname"] . '</td>
											<td>' . $get_farmer["email"] . '</td>
											<td>' . $get_farmer["phone"] . '</td>
											<td>' . $get_farmer["nin"] . '</td>
											<td>' . $get_farmer["lga"] . '</td>
											<td>' . $get_farmer["farm_location"] . '</td>
											<td>' . $get_farmer["address"] . '</td>
											<td><img src="static/farmer/' . $get_farmer["photo"] . '" style="width: 100px; height: 100px; object-fit: cover; object-position: center;" /></td>
										</tr>';
							}
						}

						?>

					</tbody>
				</table>
			</div>

			<div class="mt-5 mb-2">
				<span class="fw-bold">Current Page: <?php echo $current_page; ?></span>
			</div>
			<div class="col-5">

				<div class="row gap-2 my-2">
					<button type="button" class="btn btn-secondary col p-2"><a class="nav-link"
							href="?id=<?php echo $prev_page; ?>&search=<?php echo $search_text; ?>">Prev</a></button>
					<button type="button" class="btn btn-secondary col p-2"><a class="nav-link"
							href="?id=<?php echo $next_page; ?>&search=<?php echo $search_text; ?>">Next</a></button>
				</div>

			</div>

		</div>
	</center>



</body>

</html>