<?php

include("db_con.php");

if(isset($_GET['submit'])) {   
    
    $user = $_GET['username'];
    $pass = $_GET['password'];
    $remember = $_GET['remember_me'];

    $cryptpass = sha1($pass);
    $good = false;
    $conn = connection();
    
    
    
    
    
    $stmt = $conn->prepare("SELECT username,password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    
    $stmt->execute();
     $stmt->bind_result($username,$password)  ;
    
   // $result = $conn->query($sql);
    
    $stmt->fetch();
        
        if ($username == $user && $password == $cryptpass) {
                 session_start();
                $_SESSION['username'] = $username;
                if ($remember) {
                    setcookie("cookiename", $user, time() + 6000);
                    setcookie("cookiepass", $cryptpass, time() + 6000);
                }
                header('Location: private.php');
        }
        else
            echo "try again";
    
    $stmt->close();
    
        
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
