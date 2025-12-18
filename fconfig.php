<?php session_start();
	// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	error_reporting(0);

	$db_json = json_decode(file_get_contents("farmer-db.json"), true);
	
	//connect
	$conn = mysqli_connect($db_json["server"], $db_json["user"], $db_json["pass"]);
	
	if($conn){
		mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS ".$db_json["dbname"]);
		$db_conn = mysqli_connect($db_json["server"], $db_json["user"], $db_json["pass"], $db_json["dbname"]);
		
		mysqli_query($db_conn, "CREATE TABLE IF NOT EXISTS ".$db_json["admin_table"]." (id INT NOT NULL AUTO_INCREMENT, email VARCHAR(225) NOT NULL, date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))");
		//Create Admin Row
		if(mysqli_num_rows(mysqli_query($db_conn, "SELECT * FROM ".$db_json["admin_table"]." WHERE email='".$db_json["admin_email"]."'")) == 0){
			mysqli_query($db_conn, "INSERT INTO ".$db_json["admin_table"]." (email) VALUES ('".$db_json["admin_email"]."')");
		}
		mysqli_query($db_conn, "CREATE TABLE IF NOT EXISTS ".$db_json["agent_table"]." (id INT NOT NULL AUTO_INCREMENT, code VARCHAR(225) NOT NULL, fullname VARCHAR(225) NOT NULL, email VARCHAR(225) NOT NULL, phone VARCHAR(225) NOT NULL, address VARCHAR(225) NOT NULL, lga VARCHAR(225) NOT NULL, photo VARCHAR(225) NOT NULL, date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))");
		mysqli_query($db_conn, "CREATE TABLE IF NOT EXISTS ".$db_json["farmer_table"]." (id INT NOT NULL AUTO_INCREMENT, code VARCHAR(225) NOT NULL, fullname VARCHAR(225) NOT NULL, email VARCHAR(225) NOT NULL, phone VARCHAR(225) NOT NULL, nin VARCHAR(225) NOT NULL, bvn VARCHAR(11) NOT NULL, farm_location VARCHAR(225) NOT NULL, address VARCHAR(225) NOT NULL, lga VARCHAR(225) NOT NULL, photo VARCHAR(225) NOT NULL, date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))");
		
		
		
	}else{
		die("Connection Error");
	}
?>