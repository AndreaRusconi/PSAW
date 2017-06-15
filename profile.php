<?php 
// Controlla se la sessione Ã¨ stata registrata, altrimenti rimanda alla pagina di login 
// Questa prima parte dobbiamo inserirla in tutte le pagine che vogliamo proteggere con password prima di qualsiasi altra cosa 
session_start(); 

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/profile.css" />
    <title>Profile</title>   
</head>
    
    
    
    <body>
        
    <ul id="menu">
        <li class="other"><a href="logout.php">logout</a></li>
        <li class="other"><a href="profile.php" > <?php echo $_SESSION['username'] ?> </a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.html">info</a></li>
        <li class="other"><a href="aboutUs.html">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>
    
    <h1>
        Ciao <?php echo $_SESSION['username'] ?>!
    </h1>
        
         <input id="username" name="username" type="text" required="required" aria-required="true" value=""  placeholder="Username">
        
        
    </body>
    
</html>