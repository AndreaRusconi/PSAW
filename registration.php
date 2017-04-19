<!DOCTYPE html>
<html>
<body>
   

<?php
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    
    if(password == passwordConfirm){
        $somecontent = $username."-". $email."-".$password."<br>";
        $somecontent.= "\r\n";
    
        $myFile = "Utenti.txt";
        $fh = fopen($myFile,'at');
        fwrite($fh,$somecontent);
        fclose($fh);
    }
    else
        echo "sei un coglione"
?>
 </body></html>