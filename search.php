<html>
<head>
	<title>Rezultatet e Kerkimit</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<style>       
    hr{
        height: 1px;
        background-color: #ccc;
        border: none;
    }
</style>
<?php
	include 'functions.php';
	session_start(); 
	if (!isset($_SESSION["username"])) {
		header("Location: /filmadb/home.html");
		exit;
	}
	$conn = connect();
	$username = $_SESSION["username"];
	$match = $_GET["match"];
	$searchString = $_GET["search"];
	$results;

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
echo '<li class="nav-item">';
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

$results = doSearch($conn, $match, $searchString);

echo '<div class="form-horizontal col-md-2 col-sm-2 col-xs-6">';
echo '<form action="search.php" method=GET>';
echo "<input type=\"hidden\" name=\"match\" value=\"".$match."\">";
echo "<input type=\"hidden\" name=\"search\" value=\"".$searchString."\">";
echo '<div class="row">';
echo '<label for="sortBy">Rendit sipas: </label>';
echo '<select name="sortBy" class="form-control">';
echo '<option value="nothing" selected></option>';
echo '<option value="title">Titullit</option>';
echo '<option value="year">Vitit</option>';
echo '<option value="duration">Koh&eumlzgjatjes</option>';
echo '</select></div>';
echo '<div class="row">';
echo '<label for="sortOrder">Radha e renditjes: </label>';
echo '<select name="sortOrder" class="form-control">';
echo '<option value="nothing" selected></option>';
echo '<option value="ascending">Rrit&eumls</option>';
echo '<option value="descending">Zbrit&eumls</option>';
echo '</select>';
echo '<input type="submit" value="Rendit" class="form-control btn btn-success">';
echo '</div>';
echo '</form>';
echo '</div><br><br>';

	/*echo "<form action=\"search.php\" method=\"GET\">";
	echo "<input type=\"hidden\" name=\"match\" value=\"".$match."\">";
	echo "<input type=\"hidden\" name=\"search\" value=\""
	     .$searchString."\">";
	echo "<div style=\"color:white\">Rendit sipas:</div> ";
	echo "<select name=\"sortBy\">";
	echo "<option value=\"nothing\"></option>";
	echo "<option value=\"title\">Titulli</option>";
	echo "<option value=\"year\">Viti</option>";
	echo "<option value=\"duration\">Kohezgjatja</option>";
	echo "</select>";
	echo "    <div style=\"color:white\">Radha e renditjes:</div> ";
	echo "<select name=\"sortOrder\">";
	echo "<option></option>";
	echo "<option value=\"ascending\">Rrites</option>";
	echo "<option value=\"descending\">Zbrites</option>";
	echo "</select><br>";
	echo "<input type=\"submit\" value=\"Rezultatet e renditjes\">";
	echo "</form><br>";

	if ($_SESSION["manager"]) {
		echo "<div class=\"info\"><a href=\"addmovie.php\">";
		echo "Shto nje Film te ri</a></div>";
	}*/
/*
	if (mysqli_num_rows($results) > 0) {
		while($row = mysqli_fetch_assoc($results)) {
			echo "<div class=\"info\">";
			echo "<h2>Title: <a href=\"movie.php?id="
			     .$row["movie_id"]."\">".$row["title"]."</a></h2>"
			     ." <strong>Summary:</strong><br>".$row["summary"]
			     ."<br><br><strong>Release</strong>: "
			     .$row["release_date"]."<br><strong>"
			     ."Duration:</strong> ".$row["duration"]."<br>";
			if ($_SESSION["manager"]) {
				echo "<br><a href=\"editmovie.php?id="
				     .$row["movie_id"]."\">";
				echo "Edit Movie</a>";
			}
			echo "</div>";
		}
	} else {
		echo "<h2 class=\"bigwords\">No results found!</h2>";
	}
*/
	if (mysqli_num_rows($results) > 0) {
		$movieArray = array();
		
		while ($row = mysqli_fetch_assoc($results)) {
			array_push($movieArray, $row);
		}

		if ($_GET["sortBy"] == "title" 
		   || $_GET["sortBy"] == "year"
		   || $_GET["sortBy"] == "duration") {
			$sortBy = $_GET["sortBy"];
			$sortOrder = $_GET["sortOrder"];
			$movieArray = quicksort($movieArray, $sortBy, 
						$sortOrder);
		}

		foreach ($movieArray as $key => $value) {
			$avgRating = getAverageRating($conn, $value["movie_id"]);
			$avgRating = round($avgRating, 1, PHP_ROUND_HALF_UP);

                        echo "<h2><a href=\"movie.php?id="
                             .$value["movie_id"]."\" style=\"color: #fff\">".$value["title"]
			     ." (".$value["year"].")</a></h2>Vler&eumlsimi mesatar: <b><font size=\"+2\">".$avgRating
			     ."</font></b>/10<br><b>P&eumlrmbledhja: </b>"
			     .$value["summary"]
			     ."<br>"."<b>Koh&eumlzgjatja:</b> ".$value["duration"]."<br>";
			echo "<br><form action=\"addToWatchlist.php\" "
			     ."method=\"POST\">";
			echo "<input type=\"hidden\" name=\"id\" value="
			     .$value["movie_id"].">";
			echo "<input type=\"submit\" class=\"btn btn-success\" value=\"Shto ne Watchlist"
			     ."\"></form>";
			echo "<br><form action=\"addToFavorites.php\" "
			     ."method=\"POST\">";
			echo "<input type=\"hidden\" name=\"id\" value="
			     .$value["movie_id"].">";
			echo "<input type=\"submit\" class=\"btn btn-success\" value=\"Shto ne Te Preferuarat"
			     ."\">";
			echo "</form>";
                        if ($_SESSION["manager"]) {
                                echo "<br><a href=\"editmovie.php?id="
                                     .$value["movie_id"]."\">";
                                echo "Ndrysho te dhenat e Filmit</a><br>";
				echo "<a href=\"deletemovie.php?id="
				     .$value["movie_id"]."\">";
				echo "Fshi Filmin</a>";
                        }
                        echo "<hr>";

		}

	} else {
		echo "<h2>Nuk u gjeten rezultate!</h2>";
		echo '<h2><a href="main.php" style="color:#FFF;">Kthehu tek K&eumlrkimi</a></h2>';
	}

	$conn->close();

?>
</body>

</html>
