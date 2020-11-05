<?php
$_SESSION["isLogged"] = false;
unset($_SESSION['emailEdit']);
unset($_SESSION['addAccount']);

header("Location:/Example3/index.php?page=logIn");
exit;


