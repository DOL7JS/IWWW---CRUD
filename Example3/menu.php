<header>
<div><img src="fotbalovy-mic.jpg" width="100px" height="100px"></div>
<nav>
    <?php
    if($_SESSION["isLogged"]==true){
        echo '<a href="index.php?page=account">Můj účet</a>';
        if($_SESSION["role"]=="Admin"){
            echo '<a href="index.php?page=allAccounts">Všechny účty</a>';
        }
        echo '<a href="index.php?page=logOut">Odhlásit se</a>';
        echo '<a href="index.php?page=registration" style="display: none">Registrace</a>';
        echo '<a href="index.php?page=logIn" style="display: none">Přihlášení</a>';
    }else{
        echo '<a href="index.php?page=logIn">Přihlášení</a>';
        echo '<a href="index.php?page=registration">Registrace</a>';
    }
    ?>
</nav>
</header>