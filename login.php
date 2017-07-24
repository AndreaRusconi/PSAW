<?php
    include("db_con.php");
    if(isset($_GET['submit'])) {
        $user = $_GET['username'];
        $pass = $_GET['password'];
        $remember = $_GET['remember_me'];
        $cryptpass = sha1($pass);
        $conn = connection();
        $stmt = $conn->prepare("SELECT username,password FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->bind_result($username,$password);
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
             echo "<script>alert('error input')</script>";
        $stmt->close();
        $conn->close();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="CSS/Nobar.css"/>
        <title>Accedi al tuo profilo</title>
    </head>
    <body>
        <header>
            <p class="logoEvent"><a href="index.php"><img src="CSS/Images/logo.png" height="100px" width="300px"></a></p>
        </header>
        <form method="get" class="blocco_campi" name="login" autocomplete="off" >
            <h1 id="intestazione_blocco_campi">Accedi</h1>
            <input id="username" name="username" type="text" required="required" aria-required="true" value=""  placeholder="Username">
            <input id="password" name="password" type="password" required="required" aria-required="true" value=""  placeholder="Password">
            <div class="rememberMe">
                <input type="checkbox" id="remBox" name="remember_me" checked>
                <label id="remLabel" for="remBox">Remember me.</label>
            </div>
            <input class="tasto_giallo" name="submit" type="submit" value="Accedi">
            <p class="barretta" id="login_bar"></p>
            <h2 id="nuovo_su_event">Sei nuovo su Event?</h2>
            <div id="tasto_grigio">
                <a href="registration.php" id="to_account">Crea il tuo account</a>
            </div>
        </form>
        <footer class="footer" role="contentinfo">
            <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
        </footer>
    </body>
</html>
