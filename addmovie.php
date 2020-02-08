<html>
<head>
	<title>Shto Film</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
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
?>

  <div class="container justify-content-center col-md-4 col-sm-4 col-xs-12">
  <h2><br><br>Shto nje Film</h2><br>
  <form action="insertNewMovie.php" method=POST>
      <label for="title">Titulli:</label>
      <input type="text" name="title" class="form-control" required>
      <label for="summary"><br><br>P&eumlrmbledhja:</label>
      <textarea name="summary" class="form-control" required></textarea>
      <label for="year"><br><br>Viti i publikimit:</label>
      <input type="text" name="year" class="form-control" required>
      <label for="duration"><br>Koh&eumlzgjatja:</label>
      <input type="text" name="duration" class="form-control" required>
      <label for="lang0"><br>Gjuha(&eumlt):</label>
      <input type="text" name="lang0" class="form-control" placeholder="Gjuha 1" required>
      <br><input type="text" name="lang1" class="form-control" placeholder="Gjuha 2 (opsionale)">
      <br><input type="text" name="lang2" class="form-control" placeholder="Gjuha 3 (opsionale)">
      <label for="gen0"><br>Zhanri(et):</label>
      <input type="text" name="gen0" class="form-control" placeholder="Zhanri 1" required>
      <br><input type="text" name="gen1" class="form-control" placeholder="Zhanri 2 (opsionale)">
      <br><input type="text" name="gen2" class="form-control" placeholder="Zhanri 3 (opsionale)">
      <label for="actor0"><br>Aktor(&eumlt):</label>
      <input type="text" name="actor0" class="form-control" placeholder="Aktori 1" required>
      <br><input type="text" name="actor1" class="form-control" placeholder="Aktori 2 (opsionale)">
      <br><input type="text" name="actor2" class="form-control" placeholder="Aktori 3 (opsionale)">
      <label for="direc0"><br>Regjisor(&eumlt):</label>
      <input type="text" name="direc0" class="form-control" placeholder="Regjisori 1" required>
      <br><input type="text" name="direc1" class="form-control" placeholder="Regjisori 2 (opsionale)">
      <label for="screen0"><br>Skenarist(&eumlt):</label>
      <input type="text" name="screen0" class="form-control" placeholder="Skenaristi 1" required>
      <br><input type="text" name="screen1" class="form-control" placeholder="Skenaristi 2 (opsionale)">
      <br><input type="text" name="screen2" class="form-control" placeholder="Skenaristi 3 (opsionale)">
      <label for="tag0"><br>Etiketa:</label>
      <input type="text" name="tag0" class="form-control" placeholder="Etiketa 1" required>
      <br><input type="text" name="tag1" class="form-control" placeholder="Etiketa 2 (opsionale)">
      <br><input type="text" name="tag2" class="form-control" placeholder="Etiketa 3 (opsionale)">
      <label for="imdb"><br>IMDb link:</label>
      <input type="text" name="imdb" class="form-control" placeholder="Kodi i filmit" required>
      <label for="poster"><br>Poster link:</label>
      <input type="text" name="poster" class="form-control" placeholder="URL e fotos" required>
      <br>
    <input type="submit" class="form-control btn btn-success" value="Shto Filmin" required>
  	</form>
	</div>

</body>
</html>
