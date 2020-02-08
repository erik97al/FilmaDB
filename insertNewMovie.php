<html>
<head>
        <title>Shtimi i Filmit</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
	include 'functions.php';
        session_start();
        if(!isset($_SESSION["username"]) || !$_SESSION["manager"]) {
                header("Location: /filmadb/home.html");
                exit;
        }
        $username = $_SESSION["username"];
        
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

$conn = connect();
        
$movieId = insertMovies($_POST, $conn);
insertLanguages($conn, $movieId, $_POST);
insertGenres($conn, $movieId, $_POST);
insertTags($conn, $movieId, $_POST);
insertActors($conn, $movieId, $_POST);
insertDirectors($conn, $movieId, $_POST);
insertScreenwriters($conn, $movieId, $_POST);

echo '<br><a style="color:#FFF;size:150%;"><b>Filmi u shtua me sukses!</b></a>';
echo '<br><a href="addmovie.php" style="color:#FFF;size:150%;"><b>Shto nj&euml tjet&eumlr film</b></a>';
?>
</body>
</html>
