<?php

// ------------------------ FUNKSIONET -----------------------------------------
function connect()
{
        // lidhet me databazen
        $conn = mysqli_connect("localhost", "root",
                               "", "filmadb");
        if (!$conn) {
                echo "Lidhja me databazen deshtoi: " . mysqli_connect_error();
                exit;
        }
        return $conn;
}
// ------------------ USER LOGIN NGA MAIN.PHP -------------------------------
function fromHome($postVars) {
        // kontrollon nese variablat nga home.html jane te vendosura
        $varsSet = True;
        if (!isset($postVars["Username"]))
                $varsSet = False;
        if (!isset($postVars["Password"]))
                $varsSet = False;
        return $varsSet;
}

function login($postVars, $conn) {
        // ben log in nje perdorues ekzistues
        $username = $postVars["Username"];
        $password = hash('sha256', $postVars["Password"]);

        // krijon query string per password
        $passQueryString = "SELECT * FROM USERS WHERE username = '"
                        .$username."';";

        // merr rezultatin nga databaza dhe e vendos ne nje vektor asociativ
        $passResult = $conn->query($passQueryString);
        $passRow = mysqli_fetch_assoc($passResult);

        // kontrollon password e dhene nga perdoruesi
        if ($password != $passRow["password"]) {
                exit("Nuk lejohet hyrja. Emri i perdoruesit ose fjalekalimi nuk mund te verifikohet.");
        }

        return $passRow["isManager"];
}

// ------------- REGJISTRIMI NGA USER_REGISTRATION.HTML ----------------
function fromUserReg($postVars) {
        // kontrollon nese variablat nga user_registration.html jane vendosur

        $varsSet = True;
        if (!isset($postVars["Username"]))
                $varsSet = False;
        if (!isset($postVars["Password"]))
                $varsSet = False;
        if (!isset($postVars["Emri"]))
                $varsSet = False;
        if (!isset($postVars["Mbiemri"]))
                $varsSet = False;
        if (!isset($postVars["month"]))
                $varsSet = False;
        if (!isset($postVars["day"]))
                $varsSet = False;
        if (!isset($postVars["year"]))
                $varsSet = False;
        if (!isset($postVars["Gjinia"]))
                $varsSet = False;
        return $varsSet;
}

function registerUser($postVars, $conn) {
        // krijon perdorues te ri ne databaze
        $username = $postVars["Username"];
        $password = hash('sha256', $postVars["Password"]);
        $emri = $postVars["Emri"];
        $mbiemri = $postVars["Mbiemri"];
        $dtl = $postVars["year"]."-".$_POST["month"]."-".$_POST["day"];
        $gjinia = $postVars["Gjinia"];
        $isManager = 0;

        $userQueryString = "SELECT * FROM USERS WHERE USERNAME='".$username."'";
        $userResult = $conn->query($userQueryString);

        if (mysqli_num_rows($userResult)) {
                exit("Username i dhene ekziston. Ju lutem shkruani nje username tjeter.");
        }

        // krijon string per te shtuar ne tabelen USERS
        $insertUserString = "INSERT INTO USERS(username, emri, mbiemri,"
                           ."dtl, gjinia, isManager, password)"
                           ." VALUES ('".$username."', '".$emri."', '".$mbiemri."', '".$dtl."', '"
                           .$gjinia."', '".$isManager."', '".$password
                           ."');";

        $conn->query($insertUserString);
}

//--------------------------------KERKIMI-------------------------------
function doSearch($conn, $match, $searchString)
{
        switch($match) {
                case "title":
                {
                        echo "<div class=\"bigwords\">";
                        echo "<h1>Rezultatet e k&eumlrkimit p&eumlr filmat me '"
			     .$searchString."' n&euml titull...</h1>";
                        echo "</div>";
                        $queryString = "SELECT * FROM MOVIES WHERE TITLE LIKE"
                                       ." '%".$searchString."%';";
                        $searchResult = $conn->query($queryString);
                        return $searchResult;
                }
                case "genre":
                {
                        echo "<div class=\"bigwords\">";
                        echo "<h1>Rezultatet e k&eumlrkimit p&eumlr filmat e zhanrit '"
                             .$searchString."'...</h1>";
                        echo "</div>";
                        $queryString = "SELECT * FROM MOVIES AS M"
                                      ." WHERE M.MOVIE_ID IN (SELECT MOVIE_ID"
                                      . " FROM GENRES WHERE GENRE "
                                      ."LIKE '%".$searchString."%');";
                        $searchResult = $conn->query($queryString);
                        return $searchResult;
                }
                case "director":
		{
                        echo "<div class=\"bigwords\">";
                        echo "<h1>Rezultatet e k&eumlrkimit p&eumlr filmat me regjisor '"
                             .$searchString."'...</h1>";
                        echo "</div>";
                        $queryString = "SELECT * FROM MOVIES AS M WHERE "
                                      ."M.MOVIE_ID IN (SELECT MOVIE_ID FROM "
                                      ."DIRECTORS WHERE DIRECTOR LIKE '%"
                                      .$searchString."%');";
                        $searchResult = $conn->query($queryString);
                        return $searchResult;
                }
                case "actor":
                {
                        echo "<div class=\"bigwords\">";
                        echo "<h1>Rezultatet e k&eumlrkimit p&eumlr filmat me aktor '"
                             .$searchString."'...</h1>";
                        echo "</div>";
                        $queryString = "SELECT * FROM MOVIES AS M WHERE "
                                      ."M.MOVIE_ID IN (SELECT MOVIE_ID FROM "
                                      ."ACTORS WHERE ACTOR LIKE '%"
                                      .$searchString."%');";
                        $searchResult = $conn->query($queryString);
                        return $searchResult;
                }
		case "language":
		{
			echo "<div class=\"bigwords\">";
                        echo "<h1>Rezultatet e k&eumlrkimit p&eumlr filmat n&euml gjuh&eumln '"
                             .$searchString."'...</h1>";
                        echo "</div>";
                        $queryString = "SELECT * FROM MOVIES AS M WHERE "
                                      ."M.MOVIE_ID IN (SELECT MOVIE_ID FROM "
                                      ."LANGUAGES WHERE LANGUAGE LIKE '%"
                                      .$searchString."%');";
                        $searchResult = $conn->query($queryString);
                        return $searchResult;
		}
		case "screenwriter":
		{
			echo "<div class=\"bigwords\">";
                        echo "<h1>Rezultatet e k&eumlrkimit p&eumlr filmat me skenarist '"
                             .$searchString."'...</h1>";
                        echo "</div>";
                        $queryString = "SELECT * FROM MOVIES AS M WHERE "
                                      ."M.MOVIE_ID IN (SELECT MOVIE_ID FROM "
                                      ."SCREENWRITERS WHERE SCREENWRITER LIKE '%"
                                      .$searchString."%');";
                        $searchResult = $conn->query($queryString);
                        return $searchResult;
		}
		case "tag":
		{
			echo "<div class=\"bigwords\">";
                        echo "<h1>Rezultatet e k&eumlrkimit p&eumlr filmat sipas etiket&eumls '"
                             .$searchString."'...</h1>";
                        echo "</div>";
                        $queryString = "SELECT * FROM MOVIES AS M WHERE "
                                      ."M.MOVIE_ID IN (SELECT MOVIE_ID FROM "
                                      ."TAGS WHERE TAG LIKE '%"
                                      .$searchString."%');";
                        $searchResult = $conn->query($queryString);
                        return $searchResult;
		}
                default:
                {
                        return;
                }
        }
}

// ------------------------MARRJA NGA DATABAZA-------------------------
function getFromUsers($conn)
{
        $queryString = "SELECT * FROM USERS WHERE USERNAME = '".$_SESSION['username']."';";
        $searchResult = $conn->query($queryString);
        return mysqli_fetch_assoc($searchResult);
}

function getFromMovies($conn, $movieId)
{
        $queryString = "SELECT * FROM MOVIES WHERE MOVIE_ID = ".$movieId.";";
        $searchResult = $conn->query($queryString);
        return mysqli_fetch_assoc($searchResult);
}

function getFromLanguages($conn, $movieId)
{
        $queryString = "SELECT * FROM LANGUAGES WHERE MOVIE_ID = ".$movieId.";";
        return $conn->query($queryString);
}

function getFromGenres($conn, $movieId)
{
        $queryString = "SELECT * FROM GENRES WHERE MOVIE_ID = "
                       .$movieId.";";
        return $conn->query($queryString);
}

function getFromTags($conn, $movieId)
{
        $queryString = "SELECT * FROM TAGS WHERE MOVIE_ID = "
                       .$movieId.";";
        return $conn->query($queryString);
}

function getFromActors($conn, $movieId)
{
        $queryString = "SELECT * FROM ACTORS WHERE MOVIE_ID = ".$movieId.";";
        return $conn->query($queryString);
}

function getFromDirectors($conn, $movieId) {
        $queryString = "SELECT * FROM DIRECTORS WHERE MOVIE_ID = "
                       .$movieId.";";
        return $conn->query($queryString);
}

function getFromScreenwriters($conn, $movieId) {
        $queryString = "SELECT * FROM SCREENWRITERS WHERE MOVIE_ID = "
                       .$movieId.";";
        return $conn->query($queryString);
}

function getFromRatings($conn, $movieId) {
        $queryString = "SELECT * FROM RATINGS WHERE MOVIE_ID = ".$movieId.";";
        return $conn->query($queryString);
}

function getFromWatchList($conn, $username) {
	$queryString = "SELECT * FROM MOVIES AS M WHERE "
			."M.MOVIE_ID IN (SELECT MOVIE_ID FROM "
			."WATCHLIST WHERE USERNAME = '".$username."');";
	$searchResult = $conn->query($queryString);
	return $searchResult;
}

function getFromFavorites($conn, $username) {
    $queryString = "SELECT * FROM MOVIES AS M WHERE "
            ."M.MOVIE_ID IN (SELECT MOVIE_ID FROM "
            ."FAVORITES WHERE USERNAME = '".$username."');";
    $searchResult = $conn->query($queryString);
    return $searchResult;
}

function getAverageRating($conn, $movieId) {
	$queryString = "SELECT AVG(rating) FROM RATINGS WHERE movie_id = "
		.$movieId.";";

	$result = $conn->query($queryString);

	$row = mysqli_fetch_assoc($result);

	return $row["AVG(rating)"];
}

//--------------------SHTIMI I TE DHENAVE TE FILMIT--------------------------------
function insertMovies($post, $conn)
{
        // shton ne tabelen MOVIES dhe kthen movie_id
        $queryString = "INSERT INTO MOVIES(title, summary, year, "
                      ."duration, imdb, poster) VALUES ('".$post["title"]
                      ."', '".$post["summary"]."', '".$post["year"]."', '"
                      .$post["duration"]."', '".$post["imdb"]."', '".$post["poster"]."');";
        $retrievalString = "SELECT * FROM MOVIES WHERE TITLE = '"
                           .$post["title"]."';";

        $conn->query($queryString);

        $result = $conn->query($retrievalString);
        $row = mysqli_fetch_assoc($result);
        return $row["movie_id"];
}

function insertLanguages($conn, $movieId, $post) {
        // shton ne tabelen LANGUAGES
        for ($i = 0; $i < 3; $i++) {
                $pVar = "lang".$i;
                if ($post[$pVar] != "") {
                        $queryString = "INSERT INTO LANGUAGES(movie_id, "
                                ."language) VALUES ("
                                .$movieId.", '".$post[$pVar]."');";
                        $conn->query($queryString);
                }
        }
}

function insertGenres($conn, $movieId, $post) {
        // shton ne tabelen GENRES
        for ($i = 0; $i < 3; $i++) {
                $pVar = "gen".$i;
                if ($post[$pVar] != "") {
                        $queryString = "INSERT INTO GENRES(genre, "."movie_id) VALUES ('"
                                .$post[$pVar]."', ".$movieId.");";
                        $conn->query($queryString);
                }
        }
}

function insertTags($conn, $movieId, $post) {
        // shton ne tabelen TAGS
        for ($i = 0; $i < 3; $i++) {
                $pVar = "tag".$i;
                if ($post[$pVar] != "") {
                        $queryString = "INSERT INTO TAGS(tag, ".
                        "movie_id) VALUES ('"
                                .$post[$pVar]."', ".$movieId.");";
                        $conn->query($queryString);
                }
        }
}

function insertActors($conn, $movieId, $post) {
        // shton ne tabelen ACTORS
        for ($i = 0; $i < 3; $i++) {
                $pVar = "actor".$i;
                if ($post[$pVar] != "") {
                        $queryString = "INSERT INTO ACTORS(movie_id, "."actor) VALUES ("
                                .$movieId.", '".$post[$pVar]."');";
                        $conn->query($queryString);
                }
        }
}

function insertDirectors($conn, $movieId, $post) {
        // shton ne tabelen DIRECTORS
        for ($i = 0; $i < 2; $i++) {
                $pVar = "direc".$i;
                if ($post[$pVar] != "") {
                        $queryString = "INSERT INTO DIRECTORS(movie_id, "."director) VALUES ("
                                .$movieId.", '".$post[$pVar]."');";
                        $conn->query($queryString);
                }
        }
}

function insertScreenwriters($conn, $movieId, $post) {
        // shton ne tabelen SCREENWRITERS
        for ($i = 0; $i < 3; $i++) {
                $pVar = "screen".$i;
                if ($post[$pVar] != "") {
                        $queryString = "INSERT INTO SCREENWRITERS(movie_id, "."screenwriter) VALUES ("
                                .$movieId.", '".$post[$pVar]."');";
                        $conn->query($queryString);
                }
        }
}

//-----------------SHTIMI I REVIEW--------------------------------------
function addReview($conn, $username, $rating, $review, $movieId)
{
        $queryString = "INSERT INTO RATINGS(username, "."movie_id, "."rating, "."review) VALUES ('"
                       .$username."', ".$movieId.", "
                       .$rating.", '".$review."');";
        $conn->query($queryString);
}

//-------------------SHTIMI I FILMIT NE LISTA-----------------------------------
function addToWatchList($conn, $username, $movieId)
{
	$queryString = "INSERT INTO WATCHLIST(username, "."movie_id) VALUES('".$username."', "
			.$movieId.");";
	$conn->query($queryString);
}

function checkWatchList($conn, $username, $movieId)
{
    $queryString = "SELECT * FROM WATCHLIST WHERE username='".$username."' AND movie_id='".$movieId."'";
    $result = $conn->query($queryString);

    if(mysqli_num_rows($result))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function addToFavorites($conn, $username, $movieId)
{
    $queryString = "INSERT INTO FAVORITES(username, "."movie_id) VALUES('".$username."', "
            .$movieId.");";
    $conn->query($queryString);
}

function checkFavorites($conn, $username, $movieId)
{
    $queryString = "SELECT * FROM FAVORITES WHERE username='".$username."' AND movie_id='".$movieId."'";
    $result = $conn->query($queryString);

    if(mysqli_num_rows($result))
    {
        return true;
    }
    else
    {
        return false;
    }
}

//------------------SHTIMI I TAGS------------------------------
function addTag($conn,$movieId,$tag){
    $queryString="INSERT INTO TAGS(tag, "."movie_id) VALUES('".$tag."',".$movieId.");";
    $conn ->query($queryString);
}

//-------------PERDITESIMI I DATABAZES--------------------------------------
function updateUsers($conn, $post){
    $emri = $post["Emri"];
    $mbiemri = $post["Mbiemri"];
    $gjinia = $post["Gjinia"];
    $dtl = $post["year"]."-".$post["month"]."-".$post["day"];

    $queryString = "UPDATE USERS SET emri='".$emri
        ."', mbiemri='".$mbiemri."', dtl='"
        .$dtl."', gjinia='".$gjinia
        ."' WHERE username = '".$_SESSION['username']."';";
    $conn->query($queryString);
}

function checkPassword($conn, $post)
{
    $oldpassword = hash('sha256', $post["oldpassword"]);

    $passQueryString = "SELECT * FROM USERS WHERE username = '".$_SESSION['username']."';";
    $passResult = $conn->query($passQueryString);
    $passRow = mysqli_fetch_assoc($passResult);

    if ($oldpassword == $passRow["password"]) {
        return true;
    }
    return false;
}

function updatePassword($conn, $post){
    $newpassword = hash('sha256', $post["newpassword"]);

    $queryString = "UPDATE USERS SET password = '".$newpassword."' WHERE username = '".$_SESSION['username']."';";
    $conn->query($queryString);
}

function updateMovies($conn, $post) {
	$queryString = "UPDATE MOVIES SET title='".$post["title"]
		."', summary='".$post["summary"]."', year='"
		.$post["year"]."', duration='".$post["duration"]
		."', imdb='".$post["imdb"]."', poster='".$post["poster"]."' WHERE movie_id = ".$post["movieId"].";";
	$conn->query($queryString);
}

function updateLanguages($conn, $post) {
	for ($i = 0; $i < 3; $i++) {
		$key = "lang".$i;
		if ($post[$key] != "") {
			$queryString = "REPLACE INTO LANGUAGES(movie_id, "."language) VALUES ("
				.$post["movieId"].", '".$post[$key]
				."');";
			$conn->query($queryString);
		}
	}	
}

function updateGenres($conn, $post) {
	for ($i = 0; $i < 3; $i++) {
                $key = "gen".$i;
                if ($post[$key] != "") {
                        $queryString = "REPLACE INTO GENRES(genre, "."movie_id) VALUES ('"
                                .$post[$key]."', ".$post["movieId"]
                                .");";
                        $conn->query($queryString);
                }
        }  
}

function updateTags($conn, $post) {
	for ($i = 0; $i < 3; $i++) {
                $key = "tag".$i;
                if ($post[$key] != "") {
                        $queryString = "REPLACE INTO TAGS(tag, "."movie_id) VALUES ('"
                                .$post[$key]."', ".$post["movieId"]
                                .");";
                        $conn->query($queryString);
                }
        }
}

function updateActors($conn, $post) {
	for ($i = 0; $i < 3; $i++) {
                $key = "actor".$i;
                if ($post[$key] != "") {
                        $queryString = "REPLACE INTO ACTORS(movie_id, "."actor) VALUES ("
                                .$post["movieId"].", '".$post[$key]
                                ."');";
                        $conn->query($queryString);
                }
        } 
}

function updateDirectors($conn, $post) {
	for ($i = 0; $i < 2; $i++) {
                $key = "direc".$i;
                if ($post[$key] != "") {
                        $queryString = "REPLACE INTO DIRECTORS(movie_id, "."director) VALUES ("
                                .$post["movieId"].", '".$post[$key]
                                ."');";
                        $conn->query($queryString);
                }
        } 
}

function updateScreenwriters($conn, $post) {
	for ($i = 0; $i < 3; $i++) {
                $key = "screen".$i;
                if ($post[$key] != "") {
                        $queryString = "REPLACE INTO SCREENWRITERS(movie_id, "."screenwriter) VALUES ("
                                .$post["movieId"].", '".$post[$key]
                                ."');";
                        $conn->query($queryString);
                }
        } 
}

//------------------RENDITJA-----------------------------------------------
function quicksort($movieArray, $sortBy, $sortOrder)
{
	if(count($movieArray) < 2) {
		return $movieArray;
	}
	$left = $right = array();
	reset($movieArray);
	$pivKey = key($movieArray);
	$pivot = array_shift($movieArray);
	if ($sortOrder == "ascending") {
		foreach($movieArray as $key => $value) {
			if ($value[$sortBy] < $pivot[$sortBy])
				$left[$key] = $value;
			else
				$right[$key] = $value;
		}
	} else {
		foreach($movieArray as $key => $value) {
                        if ($value[$sortBy] > $pivot[$sortBy])
                                $left[$key] = $value;
                        else
                                $right[$key] = $value;
		}
	}
	return array_merge(quicksort($left, $sortBy, $sortOrder),
			   array($pivKey => $pivot),
			   quicksort($right, $sortBy, $sortOrder));
}

//------------------------SHTIMI I MENAXHERIT---------------------------
function getNonManagers($conn)
{
	$queryString = "SELECT * FROM USERS WHERE isManager = 0";
	return $conn->query($queryString);
}

function updatePrivileges($conn, $username)
{
	$queryString = "UPDATE USERS SET isManager = 1 WHERE username = '"
			.$username."';";
	$conn->query($queryString);
}

//--------------------------FSHIRJA----------------------------------
function deleteMovie($conn, $movieId)
{
	// Remove anything dependent on the movie_id, then delete
	// from the movies table
	$actorString = "DELETE FROM ACTORS WHERE movie_id = ".$movieId.";";
	$directorString = "DELETE FROM DIRECTORS WHERE movie_id = ".$movieId.";";
	$languageString = "DELETE FROM LANGUAGES WHERE movie_id = ".$movieId.";";
	$genreString = "DELETE FROM GENRES WHERE movie_id = ".$movieId.";";
	$tagString = "DELETE FROM TAGS WHERE movie_id = ".$movieId.";";
	$ratingsString = "DELETE FROM RATINGS WHERE movie_id = ".$movieId.";";
	$writerString = "DELETE FROM SCREENWRITERS WHERE movie_id = ".$movieId.";";
	$watchString = "DELETE FROM WATCHLIST WHERE movie_id = ".$movieId.";";
    $favString = "DELETE FROM FAVORITES WHERE movie_id = ".$movieId.";";
	$movieString = "DELETE FROM MOVIES WHERE movie_id = ".$movieId.";";

	$conn->query($actorString);
	$conn->query($directorString);
	$conn->query($languageString);
	$conn->query($genreString);
	$conn->query($tagString);
	$conn->query($ratingsString);
	$conn->query($writerString);
	$conn->query($watchString);
    $conn->query($favString);
	$conn->query($movieString);
}

function deleteValue($conn, $movieId, $value, $table, $column)
{

    $sql = "DELETE FROM ".$table." WHERE movie_id = ".$movieId." AND ".$column." = '".$value."';";
	echo $sql;
    $conn->query($sql);
}

?>
