
<h1>Přihlášení</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);

if($_POST){

    $stmt = $conn->prepare("SELECT * FROM db_dev.users WHERE email=? AND password=?");
    $stmt->bind_param("ss",$email,$userPassword);
    $email = $_POST["email"];
    $userPassword = $_POST["password"];
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows()>0){
        $stmt->bind_result($id, $emailb, $usePassword,$role);
        $stmt->fetch();
        $_SESSION["isLogged"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["userPassword"] = $userPassword;
        $_SESSION["role"] = $role;
        echo "Jste prihlasen";
        echo "logged:".$_SESSION["isLogged"];
        header("Location:/Example3/index.php?page=account");
        exit;
    }else{
        echo "Nespravne udaje";
    }
}

?>
<div class="centerForm">
    <form action="/Example3/index.php?page=logIn" method="post">
        <div class="row"><label>Email: </label><input type="email" name="email" ></div>
        <div class="row"><label>Heslo: </label><input type="password" name="password"></div>
        <div class="row"><label></label><input type="submit" value="Přihlásit" name=""></div>
    </form>
</div>

