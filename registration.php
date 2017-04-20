
<?php

    $username = $_POST['UserName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    $cryptpassword= crypt($password);

      $somecontent = $username."-".$email."-".$cryptpassword;
        $somecontent.= "\r\n";
    
    
    if($password == $passwordConfirm){
        $myFile = "Utenti.txt";
        $fh = fopen($myFile,'a+');
        fwrite($fh,$somecontent);
        fclose($myFile);
    }
    else
        echo "sei un coglione";
?>