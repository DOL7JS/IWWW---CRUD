<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Všechny účty</title>
    <link rel="stylesheet" href="../css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
<h1>Všechny účty</h1>
<?php
if(!$_SESSION["isLogged"]||$_SESSION["role"]!="Admin"){
    echo "Nejsi prihlasen";
    exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
;
$sql = "SELECT id, email, password,role FROM db_dev.users";
$result = $conn->query($sql);
?>

<?php
    if ($result->num_rows > 0) {
echo "<table style='padding-left:40%'><tr><th>ID</th><th>Email</th><th>Heslo</th><th>Role</th></tr>";
    while($row = $result->fetch_assoc()) {

        echo "<tr>
        <td> ".$row["id"].   "</td>
        <td>".$row["email"].   "</td>
        <td>".$row["password"].   "</td>
        <td>".$row["role"]."</td>
 </tr>";
    }
    echo "</table>";
} else {
echo "0 results";
}
$sql2 = "SELECT email FROM db_dev.users";
$result2 = $conn->query($sql);
?>
<div id="editTable">
    <h2>Úprava uživatelů</h2>
    <form action="/Example3/index.php?page=registration" method="post">
        <input type="submit" name="addAccount" value="Pridat uzivatele">
    </form>
<?php
echo'<form  method="post">';
echo '<select name="editedAccount">';
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        echo "<option>" . $row{'email'} . "</option>";
    }
}
echo '<select>';
echo '    <input type="submit" value="Upravit zaznam">';
echo '</form>';
?>
    <form action="Example3/index.php?page=allAccounts" method="post">
        <input type="submit" name="deleteAll" value="Odstranit vsechny uzivatele">
    </form>

</div>

<?php
if(!empty($_POST["deleteAll"])){
    echo "DELETE ALL";
    $sql = "DELETE FROM db_dev.users";
    $result = $conn->query($sql);
    header("Location:/Example3/index.php?page=logOut");
}
if(!empty($_POST["editedAccount"])){
    $stmt = $conn->prepare("SELECT * FROM db_dev.users WHERE email=?");
    $stmt->bind_param("s",$email);
    $email = $_POST["editedAccount"];
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows()>0){
        $stmt->bind_result($id, $emailb, $usePassword,$role);
        $stmt->fetch();
        $_SESSION["emailEdit"] = $emailb;
        $_SESSION["userPasswordEdit"] = $usePassword;
        $_SESSION["roleEdit"] = $role;
        echo "Jste prihlasen";
        echo "logged:".$_SESSION["isLogged"];
        header("Location:/Example3/index.php?page=account");
        exit;
    }
}
if(!empty($_POST["addAccount"])){
    $_SESSION["addAccount"] = true;
}
?>

</body>
</html>
