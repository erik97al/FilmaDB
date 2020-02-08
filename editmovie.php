<html>
<head>
	<title>Ndrysho te dhenat e filmit</title>
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
	if(!isset($_GET["id"])) {
		exit("Gabim: movie_id e pasakte");
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

	$conn = connect();
	$movieId = $_GET["id"];
	$fromMovieTable = getFromMovies($conn, $movieId);
        $title = $fromMovieTable["title"];
        $summary = $fromMovieTable["summary"];
        $year = $fromMovieTable["year"];
        $duration = $fromMovieTable["duration"];
        $imdb = $fromMovieTable["imdb"];
        $poster = $fromMovieTable["poster"];

	$fromLanguageTable = getFromLanguages($conn, $movieId);
	$languages = array_fill(0, 3, "");
	$langIndex = 0;
	while ($row = mysqli_fetch_assoc($fromLanguageTable)) {
		$languages[$langIndex] = $row["language"];
		$langIndex += 1;
	}

        $fromGenreTable = getFromGenres($conn, $movieId);
	$genres = array_fill(0, 3, "");
	$genIndex = 0;
	while ($row = mysqli_fetch_assoc($fromGenreTable)) {
		$genres[$genIndex] = $row["genre"];
		$genIndex += 1;
	}

        $fromTagTable = getFromTags($conn, $movieId);
	$tags = array_fill(0, 3, "");
        $tagIndex = 0;
        while ($row = mysqli_fetch_assoc($fromTagTable)) {
                $tags[$tagIndex] = $row["tag"];
                $tagIndex += 1;
        }

        $fromActorTable = getFromActors($conn, $movieId);
	$actors = array_fill(0, 3, "");
	$actIndex = 0;
        while ($row = mysqli_fetch_assoc($fromActorTable)) {
                $actors[$actIndex] = $row["actor"];
                $actIndex += 1;
        }

	$fromDirectorTable = getFromDirectors($conn, $movieId);
	$directors = array_fill(0, 2, "");
        $dirIndex = 0;
        while ($row = mysqli_fetch_assoc($fromDirectorTable)) {
                $directors[$dirIndex] = $row["director"];
                $dirIndex += 1;
        }

        $fromScreenwriters = getFromScreenwriters($conn, $movieId);
	$screenwriters = array_fill(0, 3, "");
        $screenIndex = 0;
        while ($row = mysqli_fetch_assoc($fromScreenwriters)) {
                $screenwriters[$screenIndex] = $row["screenwriter"];
                $screenIndex += 1;
        }



  echo "<div class=\"container justify-content-center col-md-4 col-sm-4 col-xs-12\">";
    echo "<h2><br>Ndrysho t&euml dh&eumlnat e filmit</h2><br><br>";

    echo "<form action=\"updateMovie.php\" method=\"POST\">";

	echo "<input type=\"hidden\" name=\"movieId\" value=\""
	     .$_GET["id"]."\">";

         echo "<label for=\"title\">Titulli:</label>";
        echo "<input type=\"text\" class=\"form-control\" name=\"title\" "
	     ."value=\"".$title."\"><br>";

         echo "<label for=\"summary\">P&eumlrmbledhja:</label>";
        echo "<textarea name=\"summary\" "
	    ."value=\"".$summary."\" class=\"form-control\" ></textarea>";
        echo "<br>";

         echo "<label for=\"year\">Viti i publikimit:</label>";
        echo "<input type=\"text\" name=\"year\" class=\"form-control\" value=\""
	    .$year."\"><br>";

         echo "<label for=\"duration\">Koh&eumlzgjatja:</label>";
        echo "<input type=\"text\" name=\"duration\" class=\"form-control\" value=\""
	     .$duration."\"><br>";

         echo "<label for=\"imdb\">IMDb link:</label>";
        echo "<input type=\"text\" name=\"imdb\" class=\"form-control\" value=\""
         .$imdb."\"><br>";

         echo "<label for=\"poster\">Poster link:</label>";
        echo "<input type=\"text\" name=\"poster\" class=\"form-control\" value=\""
         .$poster."\"><br>";

         echo "<label for=\"lang0\">Gjuha(&eumlt):</label>";
	for ($i = 0; $i < 3; $i++) {
		if ($languages[$i] != "") {
			echo "<input type=\"text\" class=\"form-control\" name=\"lang".$i."\" "
			    ."value=\"".$languages[$i]."\">";
			echo "<a href=\"deletevalue.php?id=".$_GET["id"]
			     ."&table=LANGUAGES&column=language"
			     ."&value=".$languages[$i]."\">Fshi</a><br><br>";
		} else {
			echo "<input type=\"text\" class=\"form-control\" name=\"lang".$i."\"><br>";
		}
	}
        echo "<br><br>";


         echo "<label for=\"gen0\">Zhanri(et):</label>";
        for ($i = 0; $i < 3; $i++) {
                if ($genres[$i] != "") {
                        echo "<input type=\"text\" class=\"form-control\" name=\"gen".$i."\" "
                            ."value=\"".$genres[$i]."\">";
			echo "<a href=\"deletevalue.php?id=".$_GET["id"]
                             ."&table=GENRES&column=genre"
                             ."&value=".$genres[$i]."\">Fshi</a><br><br>";
                } else {
                        echo "<input type=\"text\" class=\"form-control\" name=\"gen".$i."\"><br>";
                }
        }
        echo "<br><br>";

         echo "<label for=\"actor1\">Aktor&eumlt:</label>";
        for ($i = 0; $i < 3; $i++) {
                if ($actors[$i] != "") {
                        echo "<input type=\"text\" class=\"form-control\" name=\"actor".$i."\" "
                            ."value=\"".$actors[$i]."\">";
			echo "<a href=\"deletevalue.php?id=".$_GET["id"]
                             ."&table=ACTORS&column=actor"
                             ."&value=".$actors[$i]."\">Fshi</a><br><br>";
                } else {
                        echo "<input type=\"text\" class=\"form-control\" name=\"actor".$i."\"><br>";
                }
        }
        echo "<br><br>";

         echo "<label for=\"direc1\">Regjisor(&eumlt):</label>";
        for ($i = 0; $i < 2; $i++) {
                if ($directors[$i] != "") {
                        echo "<input type=\"text\" class=\"form-control\" name=\"direc".$i."\" "
                            ."value=\"".$directors[$i]."\">";
			echo "<a href=\"deletevalue.php?id=".$_GET["id"]
                             ."&table=DIRECTORS&column=director"
                             ."&value=".$directors[$i]."\">Fshi</a><br><br>";
                } else {
                        echo "<input type=\"text\" class=\"form-control\" name=\"direc".$i."\"><br>";
                }
        }

        echo "<br><br>";


         echo "<label for=\"screen0\">Skenarist(&eumlt):</label>";
        for ($i = 0; $i < 3; $i++) {
                if ($screenwriters[$i] != "") {
                        echo "<input type=\"text\" class=\"form-control\" name=\"screen".$i."\" "
                            ."value=\"".$screenwriters[$i]."\">";
			echo "<a href=\"deletevalue.php?id=".$_GET["id"]
                             ."&table=SCREENWRITERS&column=screenwriter"
                             ."&value=".$screenwriters[$i]."\">Fshi</a><br><br>";
                } else {
                        echo "<input type=\"text\" class=\"form-control\" name=\"screen".$i."\"><br>";
                }
        }
        echo "<br><br>";


         echo "<label for=\"tag0\">Etiketat:</label>";
        for ($i = 0; $i < 3; $i++) {
                if ($tags[$i] != "") {
                        echo "<input type=\"text\" class=\"form-control\" name=\"tag".$i."\" "
                            ."value=\"".$tags[$i]."\">";
            echo "<a href=\"deletevalue.php?id=".$_GET["id"]
                             ."&table=TAGS&column=tag"
                             ."&value=".$tags[$i]."\">Fshi</a><br><br>";
                } else {
                        echo "<input type=\"text\" class=\"form-control\" name=\"tag".$i."\"><br>";
                }
        }

    echo "<input type=\"submit\" class=\"form-control btn btn-success\" value=\"Perditeso Filmin\">";
    echo "</form></div><br><br><br>";
?>

</form>
</div>


</body>
</html>
