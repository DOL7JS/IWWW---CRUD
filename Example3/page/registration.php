

<?php
if(!empty($_POST["addAccount"])||!empty($_SESSION["addAccount"])){
    echo '<h1>Přidání uživatele</h1>';
    $_SESSION["addAccount"] = true;
}else{
    echo '<h1>Registrace</h1>';

}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if($_POST){
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if(!empty($_POST["email"])&&!empty($_POST["password"])){
        $stmtSel = $conn->prepare("SELECT * FROM db_dev.users WHERE email=?");
        $stmtSel->bind_param("s", $_POST["email"]);
        $stmtSel->execute();
        $stmtSel->store_result();
        if($stmtSel->num_rows==0){
            $stmtSel->close();
            $stmt = $conn->prepare("INSERT INTO db_dev.users (email, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $userPassword, $role);
            $email = $_POST["email"];
            $userPassword = $_POST["password"];
            $role = $_POST["role"];
            $stmt->execute();
            $stmt->close();
            if($_SESSION["addAccount"]){
                unset($_SESSION['addAccount']);
                header("Location:/Example3/index.php?page=allAccounts");
            }else{
                header("Location:/Example3/index.php?page=logIn");
            }
        }else{
            $stmtSel->close();
            echo "Zadejte jine jmeno (email)";
        }
    }else{
        echo "</br>Empty email or password";
    }
}

$conn->close();
?>
<div class="centerForm">
    <form action="/Example3/index.php?page=registration" method="post">
    <div class="row"><label>Email: </label><input type="email" name="email"></div>
    <div class="row"><label>Heslo: </label><input type="password" name="password"></div>
    <div class="row"><label>Role: </label><select name="role">
                                                <option value="Admin">Admin</option>
                                                <option value="Uživatel">Uživatel</option>
                                        </select>
    </div>
        <?php
            if(!empty($_SESSION["addAccount"])){
                echo '<div class="row"><label></label><input type="submit" value="Přidat uživatele"></div>';
            }else{
                echo '<div class="row"><label></label><input type="submit" value="Registrovat"></div>';
            }

        ?>
        </form>
</div>





