<?php
session_start();

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}
include("db_con.php");

$conn = connection();

$username = $_SESSION['username'];


if(isset($_GET['submit'])) {   
    
    $oldPass = $_GET['oldpass'];
    $newPass = $_GET['newpass'];
    $confNewPass = $_GET['newpassconfirm'];
    echo $oldPass. ' '. $newPass. ''. $conNewPass; 

    $cryptpass = sha1($oldPass);
    $cryptpass1 = sha1($newPass);
   
    $conn = connection();
    
    if($newPass != $confNewPass){
        echo 'pass e conPass diverse';
        
    }
    
    else{
        
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($password);
    
        $stmt->fetch();
        $stmt->close();
        
        if ($password == $cryptpass) {
                 
            $stmt1 = $conn->prepare("UPDATE users SET password=? WHERE username = '{$username}'");
            $stmt1->bind_param("s", $cryptpass1);
    
            $stmt1->execute();
    
            $stmt1->close();
            $conn->close();
            
             
            
            header("Location: generalProfile.php?var=$username");
            
        }
        else
            echo "try again";
        
    }
     
}

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
    <link rel="stylesheet" href="CSS/Nobar.css" />
    <title>Accedi al tuo profilo</title>
</head>

<body>
<header>
    <p class="logoEvent"><a href="index.php"><img src="CSS/Images/logo.png" height="100px" width="300px"></a></p>
</header>


 <form class="blocco_campi" method = "get" >

    <h1 id="intestazione_blocco_campi">Modifica Password</h1>

    <input name="oldpass" id="old_pass" type="password" required="required" aria-required="true" autocomplete="off" placeholder="Inserisci vecchia password">

    <input name="newpass" id="new_pass" type="password" required="required" aria-required="true" autocomplete="off" placeholder="Inserisci nuova password">

     <input name="newpassconfirm" id="new_password_confirm" type="password"  required="required" aria-required="true" autocomplete="off" placeholder="conferma nuova password">


    <input id="tasto_giallo" name = "submit" type = "submit" value = "Modifica password">

</form>
