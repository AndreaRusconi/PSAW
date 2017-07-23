<?php 
session_start(); 

if(!isset($_SESSION['username'])){
    echo "non puoi visualizzare la pagina senza eseguire l'accesso";
    header ("location:login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/Bar.css" />
    <title>Event</title>   
</head>
    
<body>
    <ul id="menu">
        <li class="other"><a href="logout.php">logout</a></li>
        <li class="other"><a href="generalProfile.php?var=<?php echo $_SESSION['username'] ?>" > <?php echo $_SESSION['username'] ?> </a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.php">info</a></li>
        <li class="other"><a href="aboutUs.php">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>
    
    <h1 id="motto">Search, Share, Have fun!</h1>
    
    <ul id="option">
        <li class="share">
            <p id="condividi">Condividi la tua serata,<br> fai sapere a tutti dove ti trovi. </p>
            <a href="share.php">Share event</a>
        </li>
        
        <li class="search">
            <p id="ricerca">Cerca intorno a te,<br> trova la tua serata ideale.</p>
            <a href="search.php?var=null">Search event</a>
        </li>
    </ul>
    
    <footer class="footer" role="contentinfo">
                <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
    </footer>
      
</body>
</html>