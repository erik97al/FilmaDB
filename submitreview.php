<?php
	include 'functions.php';
	session_start(); 
        if (!isset($_SESSION["username"])) {
                header("Location: /filmadb/home.html");
                exit;
        }

	if (!isset($_POST["movie_id"])) {
		header("Location: /filmadb/main.php");
		exit;
	}

	$username = $_SESSION["username"];


	$conn = connect();
	$rating = $_POST["rating"];
	$review = $_POST["review"];
	$movieId = $_POST["movie_id"];

	addReview($conn, $username, $rating, $review, $movieId);
	echo "<h3>Vler&eumlsimi u shtua me sukses!</h3><br>";
	header("Location: /filmadb/movie.php?id="
		.$movieId);
	exit;
?>
