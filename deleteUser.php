<html>
<head>
	<title></title>
</head>
<body>
<?php
	include 'functions.php';
	session_start();
	if(!isset($_SESSION["username"])) {
		header("Location: /filmadb/home.html");
               exit;
	}

	$conn = connect();
	$username = $_SESSION["username"];
	unset($_SESSION["username"]);

    $watchString = "DELETE FROM WATCHLIST WHERE username = '".$username."';";
    $favString = "DELETE FROM FAVORITES WHERE username = '".$username."';";
    $ratingsString = "DELETE FROM RATINGS WHERE username = '".$username."';";
    $userString = "DELETE FROM USERS WHERE username = '".$username."';";

    $conn->query($watchString);
    $conn->query($favString);
    $conn->query($ratingsString);
    $conn->query($userString);

	header("Location: /filmadb/home.html");
?>
</body>
</html>