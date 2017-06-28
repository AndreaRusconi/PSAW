<?php

// Controlla se la sessione Ã¨ stata registrata, altrimenti rimanda alla pagina di login
// Questa prima parte dobbiamo inserirla in tutte le pagine che vogliamo proteggere con password prima di qualsiasi altra cosa
session_start();

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}
include("db_con.php");

$conn = connection();

$username = $_SESSION['username'];








if(empty($username)){
    $username = 'none';
}


if(empty($name)){
    $name = 'none';
}

if(empty($surname)){
    $surname = 'none';
}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/mod_pass.css" />
    <title>Accedi al tuo profilo</title>
</head>

<body>
<header>
    <p class="logoEvent"><a href="index.php"><img src="CSS/Images/logo.png" height="100px" width="300px"></a></p>
</header>


 <form class="modificapassword" method = "post" >

    <h1>Modifica Password</h1>

    <input name="oldpass" id="oldpass" type="password" required="required" aria-required="true" autocomplete="off" placeholder="Inserisci vecchia password">

    <input name="newpass" id="newpass" type="password" required="required" aria-required="true" autocomplete="off" placeholder="Inserisci nuova password">

     <input name="newpasscofirm" id="newpasswordconfirm" type="password"  required="required" aria-required="true" autocomplete="off" placeholder="conferma nuova password">


    <input id="modpass" name = "submit" type = "submit" value = "Modifica password"">

</form>
