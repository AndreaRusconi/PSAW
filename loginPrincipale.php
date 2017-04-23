<?php
session_start();
if(isset($_COOKIE['cookiename'])&& isset($_COOKIE['cookiepass'])){
    $name= $_COOKIE['cookiename'];
    $pass = $_COOKIE['cookiepass'];

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
                     <p class="logoEvent"><a href="Homepage.html"><img src="CSS/Images/logo.png" height="100px" width="300px"></a></p>
                </header>
                <form action="login.php" method="post" class="menu" name="login" autocomplete="off" novalidate="">
                    
                        <h1>Accedi</h1>
                    
                        <input id="username" name="username" type="text" required="required" aria-required="true" <?php if (isset($name)){echo "value=".$name;}else echo "";?>  placeholder="Username">
                        
                        <input id="password" name="password" type="password" required="required" aria-required="true" <?php if (isset($pass)){echo "value=".$pass;} else echo "";?>  placeholder="Password">
                        
                        <div class="rememberMe">
                        <input type="checkbox" id="remBox" name="remember_me" checked>
                                <label id="remLabel" for="remBox">Remember me.</label>
                        </div>
                    
                        <input id="accesso" name="invia" type="submit" value="Accedi">
                        
                        
                        <h2>Sei nuovo su Event?</h2>   
                    
                        <p id="new"></p>
                    
                        <div class= "account">
                         <a href="registration.html" id="createAccount">Crea il tuo account</a>
                        </div>
                       
                </form>
                
               
    
    
               
    
        <footer class="footer" role="contentinfo">
                <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
        </footer>
      
    
    
    
    
    
    
    
    
</body>
</html>