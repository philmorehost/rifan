<?php session_start();
	unset($_SESSION["admin"]);
	unset($_SESSION["agent"]);
	
	header("Location: index.php");
?>