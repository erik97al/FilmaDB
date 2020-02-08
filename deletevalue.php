<?php
	include 'functions.php';

	session_start();

	if (!$_SESSION["manager"]) {
		header("Location: /filmadb/main.php");
		exit;
	}

	$conn = connect();
	$movieId = $_GET["id"];
	$table = $_GET["table"];
	$column = $_GET["column"];
	$value = $_GET["value"];

	deleteValue($conn, $movieId, $value, $table, $column);
	header("Location: /filmadb/editmovie.php?id=".$movieId);
	exit;

?>
