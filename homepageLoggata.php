<?php 
// Controlla se la sessione Ã¨ stata registrata, altrimenti rimanda alla pagina di login 
// Questa prima parte dobbiamo inserirla in tutte le pagine che vogliamo proteggere con password prima di qualsiasi altra cosa 
session_start(); 

if(!isset($_SESSION['username'])){
    echo "non puoi visualizzare la pagina senza eseguire l'accesso";
    header ("location:loginPrincipale.php"); 
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/homepageLoggata.css" />
    <title>Event</title>   
</head>
    
<body>
    <ul id="menu">
        <li class="other"><a href="logout.php">logout</a></li>
        <li class="other"><a href="" > <?php echo $_SESSION['username'] ?> </a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="#">about us</a></li>
        <li class="other"><a href="#">assistance</a></li>
        <li class="event"><a href="Homepage.html"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>
    
    <h1>Search, Share, Have fun!</h1>
    
    <ul id="option">
        <li class="share">
            <p id="condividi">Condividi la tua serata,<br> fai sapere a tutti dove ti trovi. </p>
            <a href="#">CONDIVIDI EVENTO</a>
        </li>
        
        <li class="search">
            <p id="ricerca">Cerca intorno a te,<br> trova la tua serata ideale.</p>
            <a href="#">RICERCA EVENTO</a>
        </li>
    </ul>
    
    <footer class="footer" role="contentinfo">
                <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
    </footer>
      
</body>
</html>