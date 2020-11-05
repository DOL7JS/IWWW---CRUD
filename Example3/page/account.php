<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Účet</title>
    <link rel="stylesheet" href="../css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
<?php
if(!$_SESSION["isLogged"]){
    echo "Nejsi prihlasen";
    exit;
}

if($_POST){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    if(!empty($_POST["password"])){
        $stmt = $conn->prepare("UPDATE db_dev.users SET password=?,role=? WHERE email=?");
        $stmt->bind_param("sss",$userPassword, $role,$email);
        $userPassword = $_POST["password"];
        $role = $_POST["role"];
        $email = $_SESSION["email"];
        if(!empty($_SESSION["emailEdit"])){
            $email =  $_SESSION["emailEdit"];
        }
        $stmt->execute();
        echo "</br>New record updated successfully";
        $stmt->close();
        if(!empty($_SESSION["emailEdit"])){
            echo "IN";
            header("Location:/Example3/index.php?page=allAccounts");
        }
    }else{
        echo "</br>Empty password";
    }
}

?>
<h1>Účet</h1>
<div class="centerForm">
    <form action="/Example3/index.php?page=account" method="post">
        <div class="row"><label>Email: </label><?php if(!empty($_SESSION["emailEdit"])){echo $_SESSION["emailEdit"];}else{echo $_SESSION["email"];} ?></div>
        <div class="row"><label>Heslo: </label><input type="password" name="password" value="<?php if(!empty($_SESSION["emailEdit"])){echo $_SESSION["userPasswordEdit"];}else{echo $_SESSION["userPassword"];}?>"></div>
        <div class="row"><label>Role: </label><select name="role" >
                <?php if(!empty($_SESSION["emailEdit"])){
                    if($_SESSION["roleEdit"]=="Admin"){
                        echo '<option selected="selected" value="Admin">Admin</option>';
                        echo '<option value="Uživatel">Uživatel</option>';
                    }else{
                        echo '<option  value="Admin">Admin</option>';
                        echo '<option selected="selected" value="Uživatel">Uživatel</option>';
                    }
                }else{
                    if($_SESSION["role"]=="Admin"){
                        echo '<option selected="selected" value="Admin">Admin</option>';
                        echo '<option value="Uživatel">Uživatel</option>';
                    }else{
                        echo '<option  value="Admin">Admin</option>';
                        echo '<option selected="selected" value="Uživatel">Uživatel</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="row"><label></label><input type="submit" value="Aktualizovat" ></div>
    </form>
</div>
</body>
</html>
