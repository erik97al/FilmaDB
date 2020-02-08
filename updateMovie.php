<?php
	include 'functions.php';
        session_start(); 
        if (!isset($_SESSION["username"]) || !$_SESSION["manager"]) {
                header("Location: /filmadb/home.html");
                exit;
        }

        $username = $_SESSION["username"];

        $conn = connect();

	$movieId = $_POST["movieId"];
	$title = $_POST["title"];
	$summary = $_POST["summary"];
	$release = $_POST["year"];
	$duration = $_POST["duration"];
	$imdb = $_POST["imdb"];
	$poster = $_POST["poster"];

	updateMovies($conn, $_POST);
	updateLanguages($conn, $_POST);
	updateGenres($conn, $_POST);
	updateTags($conn, $_POST);
	updateActors($conn, $_POST);
	updateDirectors($conn, $_POST);
	updateScreenwriters($conn, $_POST);

	echo "Filmi u ndyshua me sukses!<br>";
        header("Location: /filmadb/movie.php?id=".$movieId);
	exit;
?>
