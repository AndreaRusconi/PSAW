<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie("cookiename",time()-6000);
    setcookie("cookiepass",time()-6000);
    header('Location: login.php');
?>