<?php
session_start();
if(empty($_GET["page"])){
    $_GET["page"] = "";
}
if(empty($_SESSION["isLogged"])){
    $_SESSION["isLogged"] = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
include "menu.php";
?>

<?php


//$pathToFile = "./Example3/index.php?page=".$_GET["page"].".php";

$pathToFile = "./page/".$_GET["page"].".php";

if(file_exists($pathToFile)){
    include $pathToFile;
}else{
    include "./page/logIn.php";
}
?>

<?php
include "footer.php"
?>


</body>
</html>