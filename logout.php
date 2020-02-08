<?php

session_start();
unset($_SESSION["username"]);
header("Location: /filmadb/home.html");
exit;

?>
