
<?php

    $username = $_POST['UserName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    

    //if controlliamo errori possibili tipo email vuota o cose del genere
    // se non ci sono errori allora facciamo operazioni di pulizia e cose varie e intento ne scrivo alcuni che ho trovato
    
    if(strlen($username) < 21){
        if($password == $passwordConfirm){
        
            $username = trim($username);
            $email = trim($email);
            $password = trim($password);
            $passwordConfirm = trim($passwordConfirm);

            $cryptpassword= crypt($password);

            $userData = $username."-".$email."-".$cryptpassword;
            $userData.= "\r\n";
        
            $usersFile = "Users.txt";
            $fh = fopen($usersFile,'a+');
            fwrite($fh,$userData);
            fclose($usersFile);
        }
        else
            echo "il contenuto di conferma password è diverso dal contenuto di password ";
    }
    else
        echo "l'username deve avere meno di 21 caratteri";


?>