<?php
session_start();
    if(isset($_SESSION['username'])){
        $ok = true;
    }
?>



<!DOCTYPE html> 
<html> 
<head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
	<title>Information</title> 
	<link rel="stylesheet" type="text/css" href="CSS/info.css"/>


</head> 
<body> 
    
    
      <ul id="menu">
        
        <li class="other"><a href="<?php if($ok){echo "logout";} else{echo "login";} ?>.php"><?php if($ok){echo "logout";} else{echo "login";} ?></a></li>
        <li class="other"><a href="<?php if($ok){echo "generalProfile";} else{echo "registration";} ?>.php?gianni=<?php echo $_SESSION['username'] ?>"><?php if($ok){echo $_SESSION['username'];} else{echo 'sign up';} ?></a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.php">info</a></li>
        <li class="other"><a href="aboutUs.php">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>


      <ul id=instruction">
                         
        <li class="title">Search!</li>
                       
        <li class="descr">Cerca un evento nelle vicinanze o nella tua città. Premi su Search, con la geolocalizzazione e grazie ad altri utenti, troverai diversi eventi intorno a te! </li>
      
        <li class="title">Share!</li>
                         
        <li class="descr">Condividi un evento a cui stai partecipando! Aiuta le persone intorno a te a trovare un evento condividendo con il tasto Share. More people more fun!</li>
        
      <li class="title">Chat!</li>
     
        <li class="descr">Scrivi al segnalatore! Fai domande sull'evento, su orari o su come arrivarci.</li>
    </ul>

      <footer class="footer" role="contentinfo">
    <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
</footer>


</body>
</html>