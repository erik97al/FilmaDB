<html>
<head>
	<title>Faqja kryesore</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<script src="js/bootstrap.min.js"></script>

<?php
	include 'functions.php';
	$conn = connect();
	$username;
	session_start(); 

	if (fromUserReg($_POST)) {
		$conn = connect();
		registerUser($_POST, $conn);
		$username = $_POST["Username"];
		$_SESSION["username"] = $username;
		$_SESSION["manager"] = 0;
	}
	elseif (fromHome($_POST)) {
		$conn = connect();
		$_SESSION["manager"] = login($_POST, $conn);
		$username = $_POST["Username"];
		$_SESSION["username"] = $username;
	}
	elseif (isset($_SESSION["username"])) {
		$username = $_SESSION["username"];
	}
	if (!fromUserReg($_POST) && !fromHome($_POST) 
			         && !isset($_SESSION["username"])){
		// e kthen tek faqja login
		header("Location: /filmadb/home.html");
		exit;
	}

if ($_SESSION["manager"])
{
echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top justify-content-between">';
echo '<a class="navbar-brand"><img href="/main.php" src="image/logo.png" alt="FilmaDB" width="200px"></a>';
echo '<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';
echo '<div class="collapse navbar-collapse" id="main-navigation">';
echo '<ul class="navbar-nav">';
echo '<li class="nav-item active">';
echo '<a class="nav-link" href="main.php">Kreu</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="myWatchlist.php">Watchlist</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="myFavorites.php">T&euml Preferuarat</a>';
echo '</li>';
echo '<li class="nav-item">';
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
echo '<li class="nav-item active">';
echo '<a class="nav-link" href="main.php">Kreu</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="myWatchlist.php">Watchlist</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="myFavorites.php">T&euml Preferuarat</a>';
echo '</li>';
echo '<li class="nav-item">';
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


echo '<div class="container justify-content-center col-md-4 col-sm-4 col-xs-12">';
echo '<h2><br><br>K&eumlrko p&eumlr Filma</h2><br>';
echo '<form action="search.php" method=GET>';
echo '<div class="form-row">';
echo '<select name="match" class="form-control" required>';
echo '<option value="nothing" selected>Sipas</option>';
echo '<option value="title">Titullit</option>';
echo '<option value="genre">Zhanrit</option>';
echo '<option value="actor">Aktorit</option>';
echo '<option value="director">Regjisorit</option>';
echo '<option value="screenwriter">Skenaristit</option>';
echo '<option value="language">Gjuh&eumls</option>';
echo '<option value="tag">Etiketave</option>';
echo '</select>';
echo '<input type="text" class="form-control" name="search">';
echo '<input type="hidden" name="sortBy" value="nothing">';
echo '<input type="submit" value="Kerko" class="form-control btn btn-success">';
echo '</div>';
echo '</form>';
if ($_SESSION["manager"]) {
	echo '<br><a href="addmovie.php" style="color:#FFF;size:150%;"><b>Shto nj&euml Film t&euml ri</b></a>';
}
echo '</div>';

	$conn->close();
?>

</body>
</html>

