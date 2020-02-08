<html>
<head>
        <title>Shto Menaxhere</title>
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

        $username = $_SESSION["username"];
        $conn = connect();
        $nonManagers = getNonManagers($conn);

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
echo '<li class="nav-item active">';
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


        echo "<div class=\"container justify-content-center col-md-4 col-sm-4 col-xs-12\">";
        echo "<h3>Perdoruesit qe nuk jane menaxhere</h3><br>";
        echo "<p>Zgjidh perdoruesin qe do te shtoni tek Menaxheret:</p>";

        if (mysqli_num_rows($nonManagers) > 0) {
        echo "<form action=\"updateManagers.php\" method=\"POST\">";
        $i =0;
        while ($row = mysqli_fetch_assoc($nonManagers)) {
        echo "<div class=\"form-check\"><input type=\"checkbox\" name=\"user".$i."\" "
                                ."value=\"".$row["username"]."\"class=\"form-check-label\">";
        echo "<label for=\"user".$i."\">".$row["username"]."</label></div>";
                        $i++;
                }
                echo "<input type=\"hidden\" name=\"i\" value=".$i.">";
                echo "<br>";
                echo "<input type=\"submit\" class=\"form-control btn btn-success\" value=\"Dergo\">";
                echo "</form>";
                echo "</div>";
 
        } else {
                echo "<h3>Te gjithe perdoruesit jane menaxhere.</h3>";
        }

?>
</body>
</html>
