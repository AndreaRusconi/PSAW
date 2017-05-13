<?php

include("db_con.php");

if(isset($_GET['submit'])) {   
    
    $username = $_GET['username'];
    $password = $_GET['password'];
    $remember = $_GET['remember_me'];

    $cryptpassword = sha1($password);
    $good = false;
    $conn = connection();

    $sql = "SELECT username, password FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row["username"] == $username && $row["password"] == $cryptpassword) {
                $good = true;
                break;
            }
        }
    }
    else {
        echo "0 results";
    }

    if ($good) {
        session_start();
        $_SESSION['username'] = $username;
        if ($remember) {
            setcookie("cookiename", $username, time() + 6000);
            setcookie("cookiepass", $cryptpassword, time() + 6000);
        }
        header('Location: private.php');

    } 
        else
            echo "try again";


        
}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/login.css"/>
    <title>Accedi al tuo profilo</title>
</head>

<body>
<header>
    <p class="logoEvent"><a href="index.php"><img src="CSS/Images/logo.png" height="100px" width="300px"></a></p>
</header>
<form method="get" class="menu" name="login" autocomplete="off" novalidate="">

    <h1>Accedi</h1>

    <input id="username" name="username" type="text" required="required" aria-required="true" value=""  placeholder="Username">

    <input id="password" name="password" type="password" required="required" aria-required="true" value=""  placeholder="Password">

    <div class="rememberMe">
        <input type="checkbox" id="remBox" name="remember_me" checked>
        <label id="remLabel" for="remBox">Remember me.</label>
    </div>

    <input id="accesso" name="submit" type="submit" value="Accedi">

    <div class="dimenticata">
        <a href="#" id="link">Password dimenticata?</a>
    </div>


    <h2>Sei nuovo su Event?</h2>

    <p id="new"></p>

    <div class= "account">
        <a href="registration.php" id="createAccount">Crea il tuo account</a>
    </div>

</form>






<footer class="footer" role="contentinfo">
    <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
</footer>









</body>
</html>
