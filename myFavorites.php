<html>
<head>
    <title>Te Preferuarat</title>
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
echo '<a class="nav-link active" href="myFavorites.php">T&euml Preferuarat</a>';
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
echo '<a class="nav-link active" href="myFavorites.php">T&euml Preferuarat</a>';
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

    $results = getFromFavorites($conn, $username);

    echo "<h1>T&euml Preferuarat e ".$username."</h1><br><br>";

    if (mysqli_num_rows($results) > 0) {
                while($row = mysqli_fetch_assoc($results)) {
            $avgRating = getAverageRating($conn, $row["movie_id"]);
            $avgRating = round($avgRating, 1, PHP_ROUND_HALF_UP);

                        echo "<h2><a href=\"movie.php?id="
                             .$row["movie_id"]."\" style=\"color: #fff\">".$row["title"]
                 ." (".$row["year"].")</a></h2>Vler&eumlsimi mesatar: <b><font size=\"+2\">".$avgRating
                 ."</font></b>/10<br><b>P&eumlrmbledhja: </b>"
                 .$row["summary"]
                 ."<br>"."<b>Koh&eumlzgjatja:</b> ".$row["duration"]."<br>";
                        if ($_SESSION["manager"]) {
                                echo "<br><a href=\"editmovie.php?id="
                                     .$row["movie_id"]."\">";
                                echo "Ndrysho te dhenat e Filmit</a><br>";
                echo "<a href=\"deletemovie.php?id="
                     .$row["movie_id"]."\">";
                echo "Fshi Filmin</a>";
                        }
                        echo "<hr>";

        }
                        echo "</div>";
        } else {
                echo "<h2>Nuk ka filma n&euml k&eumlt&euml list&euml!</h2>";
        }

?>

</body>
</html>
