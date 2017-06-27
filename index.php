
<?php
include("db_con.php");


session_start();

if(isset($_SESSION['username'])){
    header("Location: private.php");
}

if(isset($_COOKIE["cookiename"]) && isset($_COOKIE["cookiepass"])){ 
    
    $good = false;
    $conn = connection();
    $sql = "SELECT username, password FROM users";
    $result = $conn->query($sql);
    
   
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row["username"] == $_COOKIE["cookiename"] && $row["password"] == $_COOKIE["cookiepass"]) {
                $good = true;
                break;
            }
        }
    }
    if ($good) {
        $_SESSION['username'] = $_COOKIE["cookiename"];
        header('Location: private.php');
    } 
}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/Homepage.css" />
    <title>Event</title>   
</head>
    
<body>
    <ul id="menu">
        <li class="other"><a href="login.php">login</a></li>
        <li class="other"><a href="registration.php">sign up</a></li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.php">info</a></li>
        <li class="other"><a href="aboutUs.php">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>
    
    <h1>Search, Share, Have fun!</h1>



    <ul id="option">
        <li class="share">
            <p id="condividi">Condividi la tua serata,<br> fai sapere a tutti dove ti trovi. </p>
            <a href="share.php">CONDIVIDI EVENTO</a>
        </li>
        
        <li class="search">
            <p id="ricerca">Cerca intorno a te,<br> trova la tua serata ideale.</p>
            <a href="search.php">RICERCA EVENTO</a>
        </li>
    </ul>
    
    <footer class="footer" role="contentinfo">
                <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
    </footer>
      
</body>
</html>