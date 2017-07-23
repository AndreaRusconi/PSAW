<?php
session_start();
$ok = false;
if(isset($_SESSION['username'])){$ok = true;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/Bar.css" />
    <title>aboutUs</title>
</head>
<body>
    <ul id="menu">
        <li class="other">
            <a href="<?php if($ok){echo "logout";} else{echo "login";} ?>.php"><?php if($ok){echo "logout";} else{echo "login";} ?></a>
        </li>
        <li class="other">
            <a href="<?php if($ok){echo "generalProfile";} else{echo "registration";} ?>.php?var=<?php echo $_SESSION['username'] ?>"><?php if($ok){echo $_SESSION['username'];} else{echo 'sign up';} ?></a>
        </li>
        <li class="barra"><a>|</a></li>
        <li class="other"><a href="info.php">info</a></li>
        <li class="other"><a href="aboutUs.php">about us</a></li>
        <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
    </ul>   
<h1 class="title">About Us</h1>
<p class="descr">
    « Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt
    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem
    ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.
    Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
    Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. »
</p>
<footer class="footer" role="contentinfo">
    <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
</footer>
</body>
</html>