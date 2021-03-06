<html>
<head>
	<title>Ndrysho te dhenat e perdoruesit</title>
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
?>

  <div class="container justify-content-center col-md-4 col-sm-4 col-xs-12">
	<h2>Ndryshimi i t&euml dh&eumlnave</h2><br>
<form action="updateUser.php" method=POST>
    <div class="form-row">
      <label for="Emri">Emri</label>
      <input type="text" name="Emri" class="form-control" placeholder="Emri" required>
      <label for="Mbiemri">Mbiemri</label>
      <input type="text" name="Mbiemri" class="form-control" placeholder="Mbiemri" required>
    </div>
    <div class="form-row">Dat&eumllindja</div>
    <div class="form-row">
      <select name="day" class="form-control" required>
        <option value="" selected>Dita</option>
      <option value="01">1</option>
      <option value="02">2</option>
      <option value="03">3</option>
      <option value="04">4</option>
      <option value="05">5</option>
      <option value="06">6</option>
      <option value="07">7</option>
      <option value="08">8</option>
      <option value="09">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
      </select>

      <select name="month" class="form-control" required>
        <option value="" selected>Muaji</option>
      <option value="01">Janar</option>
      <option value="02">Shkurt</option>
      <option value="03">Mars</option>
      <option value="04">Prill</option>
      <option value="05">Maj</option>
      <option value="06">Qershor</option>
      <option value="07">Korrik</option>
      <option value="08">Gusht</option>
      <option value="09">Shtator</option>
      <option value="10">Tetor</option>
      <option value="11">Nentor</option>
      <option value="12">Dhjetor</option>
      </select>

      <select name="year" class="form-control" required>
        <option value="" selected>Viti</option>
      <option value="2007">2007</option>
      <option value="2006">2006</option>
      <option value="2005">2005</option>
      <option value="2004">2004</option>
      <option value="2003">2003</option>
      <option value="2002">2002</option>
      <option value="2001">2001</option>
      <option value="2000">2000</option>
      <option value="1999">1999</option>
      <option value="1998">1998</option>
      <option value="1997">1997</option>
      <option value="1996">1996</option>
      <option value="1995">1995</option>
      <option value="1994">1994</option>
      <option value="1993">1993</option>
      <option value="1992">1992</option>
      <option value="1991">1991</option>
      <option value="1990">1990</option>
      <option value="1989">1989</option>
      <option value="1988">1988</option>
      <option value="1987">1987</option>
      <option value="1986">1986</option>
      <option value="1985">1985</option>
      <option value="1984">1984</option>
      <option value="1983">1983</option>
      <option value="1982">1982</option>
      <option value="1981">1981</option>
      <option value="1980">1980</option>
      <option value="1979">1979</option>
      <option value="1978">1978</option>
      <option value="1977">1977</option>
      <option value="1976">1976</option>
      <option value="1975">1975</option>
      <option value="1974">1974</option>
      <option value="1973">1973</option>
      <option value="1972">1972</option>
      <option value="1971">1971</option>
      <option value="1970">1970</option>
      <option value="1969">1969</option>
      <option value="1968">1968</option>
      <option value="1967">1967</option>
      <option value="1966">1966</option>
      <option value="1965">1965</option>
      <option value="1964">1964</option>
      <option value="1963">1963</option>
      <option value="1962">1962</option>
      <option value="1961">1961</option>
      <option value="1960">1960</option>
      <option value="1959">1959</option>
      <option value="1958">1958</option>
      <option value="1957">1957</option>
      <option value="1956">1956</option>
      <option value="1955">1955</option>
      <option value="1954">1954</option>
      <option value="1953">1953</option>
      <option value="1952">1952</option>
      <option value="1951">1951</option>
      <option value="1950">1950</option>
      </select>
  </div>
      <label for="Gjinia">Gjinia</label>
      <select name="Gjinia" class="form-control" required>
      <option value="" selected>Zgjidh</option>
      <option value="Femer">Femer</option>
      <option value="Mashkull">Mashkull</option>
      </select>
    <input type="submit" class="form-control btn btn-success" value="Ndrysho te dhenat" required>
  </form>

	<br><a href="changepass.php" style="color:#FFF;size:150%;"><b>Ndrysho fjal&eumlkalimin</b></a>
	<br><a href="deleteaccount.php" style="color:#FFF;size:150%;"><b>Fshi llogarin&euml</b></a>
</div>

<?php
	$conn->close();
?>

</body>
</html>
