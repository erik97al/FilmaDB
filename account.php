<html>
<head>
	<title>Profili im</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
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

    $fromUsersTable = getFromUsers($conn);
	$emri = $fromUsersTable["emri"];
	$mbiemri = $fromUsersTable["mbiemri"];
	$dtl = $fromUsersTable["dtl"];
	$gjinia = $fromUsersTable["gjinia"];


if ($_SESSION["manager"])
{
echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top justify-content-between">';
echo '<a class="navbar-brand"><img href="/main.php" src="image/logo.png" alt="FilmaDB" width="200px"></a>';
echo '<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';
echo '<div class="collapse navbar-collapse" id="main-navigation">';
echo '<ul class="navbar-nav">';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="main.php">Kreu</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="myWatchlist.php">Watchlist</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="myFavorites.php">T&euml Preferuarat</a>';
echo '</li>';
echo '<li class="nav-item active">';
echo '<a class="nav-link" href="account.php">Profili im</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="addManagers.php">Shto Menaxher</a>';
echo '</li>';
echo '</ul>';
echo '</div>';
echo '<span class="navbar-text white-text">';
echo "<p>Kycur si: <b>".$username."</b> (Menaxher)  ";
echo '</span>';
echo '<span>';
echo '<button class="btn btn-success btn-sm" type="button"><a class="nav-link" href="logout.php">Dil</a></button></span>';
echo '</nav>';
}

else
{
echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top justify-content-between">';
echo '<a class="navbar-brand"><img href="/main.php" src="image/logo.png" alt="FilmaDB" width="200px"></a>';
echo '<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';
echo '<div class="collapse navbar-collapse" id="main-navigation">';
echo '<ul class="navbar-nav">';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="main.php">Kreu</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="myWatchlist.php">Watchlist</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="myFavorites.php">T&euml Preferuarat</a>';
echo '</li>';
echo '<li class="nav-item active">';
echo '<a class="nav-link" href="account.php">Profili im</a>';
echo '</li>';
echo '</ul>';
echo '</div>';
echo '<span class="navbar-text white-text">';
echo "<p>Kycur si: <b>".$username."</b>  ";
echo '</span>';
echo '<span>';
echo '<button class="btn btn-success btn-sm" type="button"><a class="nav-link" href="logout.php">Dil</a></button></span>';
echo '</nav>';
}

	echo "<h2>Profili im</h2><br>";
	echo "<p>Username: <b>".$username."</b></p><br>";
	if ($_SESSION["manager"])
	{
		echo "<p>Roli: <b>Menaxher</b></p><br>";
	}
	else
	{
		echo "<p>Roli: <b>P&eumlrdorues</b></p><br>";
	}
	echo "<p>Emri: <b>".$emri." ".$mbiemri."</b></p><br>";
	echo "<p>Dat&eumllindja: <b>".$dtl."</b></p><br>";
	echo "<p>Gjinia: <b>".$gjinia."</b></p><br><br>";

	echo '<br><a href="editaccount.php" style="color:#FFF;size:150%;"><b>Ndrysho t&euml dh&eumlnat</b></a>';
	echo '<br><a href="changepass.php" style="color:#FFF;size:150%;"><b>Ndrysho fjal&eumlkalimin</b></a>';
	echo '<br><a href="deleteaccount.php" style="color:#FFF;size:150%;"><b>Fshi llogarin&euml</b></a>';

	$conn->close();

?>
</body>
</html>
