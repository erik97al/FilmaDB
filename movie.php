<html>
<head>
	<title>Te dhenat e filmit</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<style>       
    hr{
        height: 2px;
        background-color: #ccc;
        border: none;
    }
</style>
<?php
	include 'functions.php';
	session_start();
	if(!isset($_SESSION["username"])) {
		header("Location: /filmadb/home.html");
               exit;
	}
	if(!isset($_GET["id"]) || $_GET["id"] == "") {
		echo "<div id=\"top\">";
		echo "Gabim: movie_id e pasakte<br><br>";
		echo "<a href=\"main.php\">Kthehu tek Kerkimi</a>";
		echo "</div>";
		exit;
	}
	$conn = connect();
	$username = $_SESSION["username"];
	$movieId = $_GET["id"];
	
	$fromMovieTable = getFromMovies($conn, $movieId);
	$title = $fromMovieTable["title"];
	$summary = $fromMovieTable["summary"];
	$year = $fromMovieTable["year"];
	$duration = $fromMovieTable["duration"];
	$imdb = $fromMovieTable["imdb"];
	$poster = $fromMovieTable["poster"];

	$fromLanguageTable = getFromLanguages($conn, $movieId);
	$fromGenreTable = getFromGenres($conn, $movieId);
	$fromTagTable = getFromTags($conn, $movieId);
	$fromActorTable = getFromActors($conn, $movieId);
	$fromDirectorTable = getFromDirectors($conn, $movieId);
	$fromScreenwriters = getFromScreenwriters($conn, $movieId);
	$fromRatingsTable = getFromRatings($conn, $movieId);
	$avgRating = getAverageRating($conn, $movieId);

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


echo "<br><br><div class=\"row\">";
echo "<div class=\"col-sm-2\"></div>";

echo "<div class=\"col-sm-3\">";
echo "<img src=\"".$poster."\" alt=\"Poster\"><br><br>";

echo "<form action=\"addToWatchlist.php\" method=\"POST\">";
echo "<input type=\"hidden\" name=\"id\" value=".$movieId.">";
echo "<input type=\"submit\" class=\"btn btn-success\" value=\"Shto ne Watchlist\">";
echo "</form><br>";

echo "<form action=\"addToFavorites.php\" method=\"POST\">";
echo "<input type=\"hidden\" name=\"id\" value=".$movieId.">";
echo "<input type=\"submit\" class=\"btn btn-success\" value=\"Shto tek Te Preferuarat\">";
echo "</form><br>";
if ($_SESSION["manager"]) {
	echo "<a href=\"editmovie.php?id=".$movieId."\">";
	echo "Ndrysho te dhenat e Filmit</a><br>";
	echo "<a href=\"deletemovie.php?id=".$movieId."\">";
     echo "Fshi Filmin</a><br><br>";
}
echo "</div>";

echo "<div class=\"col-sm-5\">";
	echo "<br><h1>".$title." (".$year.")</h1>";
	if (mysqli_num_rows($fromGenreTable) > 0) {
		while($row = mysqli_fetch_assoc($fromGenreTable)) {
			echo "<b>".$row["genre"]." &#183 </b>";
		}
	} else {
		echo "<b>Zhanri &#183 </b>";
	}
	echo "<b>".$duration."</b><br><br>";
	echo "<p>".$summary."</p><br>";
	echo "<p>Vler&eumlsimi mesatar: <font style=\"font-size:200%;\">".round($avgRating, 1,
		PHP_ROUND_HALF_UP)."</font>/10</p><br>";
	echo "<strong>Gjuha(&eumlt): </strong>";
	if (mysqli_num_rows($fromLanguageTable) > 0) {
		while($row = mysqli_fetch_assoc($fromLanguageTable)) {
			echo $row["language"]."  ";
		}
	} else {
		echo "Nuk ka informacion.<br><br>";
	}
	echo "<br><br>";
	echo "<strong>Etiketat: </strong>";
        if (mysqli_num_rows($fromTagTable) > 0) {
                while($row = mysqli_fetch_assoc($fromTagTable)) {
                        echo $row["tag"].", ";
                }
        } else {
                echo "Nuk ka informacion.<br><br>";
        }
	echo "<br><br>";
	echo "<a href=\"addtag.php?movie_id=".$_GET["id"]
	     ."&username=".$username."\">Shto tag</a>";
echo "</div>";
echo "<div class=\"col-sm-2\"></div>";
echo "</div>";


echo "<br><br><div class=\"row\">";
echo "<div class=\"col-sm-2\"></div>";
echo "<div class=\"col-sm-8\">";
echo "<hr><br><h2>Kasti & Stafi</h2>";
echo "<br><strong>Regjisor(&eumlt): </strong><br>";
        if (mysqli_num_rows($fromDirectorTable) > 0) {
                while($row = mysqli_fetch_assoc($fromDirectorTable)) {
                        echo $row["director"]."<br>";
                }
        } else {
                echo "Nuk ka informacion.<br>";
        }
        echo "<br>";

	echo "<strong>Aktor&eumlt: </strong><br>";
        if (mysqli_num_rows($fromActorTable) > 0) {
                while($row = mysqli_fetch_assoc($fromActorTable)) {
                        echo $row["actor"]."<br>";
                }
        } else {
                echo "Nuk ka informacion.<br>";
        }
        echo "<br>";



	echo "<strong>Skenarist(&eumlt):</strong><br>";
        if (mysqli_num_rows($fromScreenwriters) > 0) {
                while($row = mysqli_fetch_assoc($fromScreenwriters)) {
                        echo $row["screenwriter"]."<br>";
                }
        } else {
                echo "Nuk ka informacion.<br>";
        }
        echo "<br>";

	echo "<strong>M&euml shum&euml informacion:  </strong><a href=\"https://www.imdb.com/title/tt".$imdb."\"><img src=\"image/imdb.png\"></a><br><br>";
	

	echo "<hr><br><h2>Vler&eumlsimet</h2>";
	echo "<a href=\"review.php?movie_id=".$_GET["id"]
	     ."\">Shto nj&euml vler&eumlsim!<br><br></a>";
        if (mysqli_num_rows($fromRatingsTable) > 0) {
                while($row = mysqli_fetch_assoc($fromRatingsTable)) {
                        echo "<b>".$row["username"].": </b><font style=\"font-size:150%;\">".$row["rating"]."</font>/10<br>";
			echo $row["review"]."<br><br>";
                }
        } else {
                echo "Nuk ka vler&eumlsime p&eumlr k&eumlt&euml film!<br>";
        }
        echo "<br>";
        echo "</div>";
        echo "<div class=\"col-sm-2\"></div>";
        echo "</div>";


	$conn->close();

?>

</body>
</html>
