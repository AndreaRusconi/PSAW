
<?php

    $username =trim( $_POST['UserName']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $useromailgiainuso = false;
    $infile = fopen("Users.txt","r");
    $entry = fgets($infile);


    while (!feof($infile)) {
        $array = explode("-",$entry);

        if(trim($array[0]) == $username || trim ($array[1])==$email){
            $useromailgiainuso= true;
            break;
        }
        $entry = fgets($infile);
    }
    
    fclose($infile);

    if(chkEmail($email)&&chkUsername($username)&& chkPassword($password,$passwordConfirm)) {
        if(!$useromailgiainuso){

            echo 'Registrazione avvenuta con successo';
            $cryptpassword=md5($password);
            $userData = $username."-".$email."-".$cryptpassword;
            $userData.= "\r\n";
            $usersFile = "Users.txt";
            $fh = fopen($usersFile,'a+');
            fwrite($fh,$userData);
            fclose($usersFile);
            header('Location: loginPrincipale.php');
        }
        else
            echo 'username o mail già in uso';
    }
    else
        echo 'Errore, la password deve essere di almeno 8 caratteri,il nome utente deve essere al massimo di 25 caratteri'  ;

    function chkEmail($email){
        $email = trim($email);
        if(!$email) {
            return false;
        }
        $num_at = count(explode( '@', $email )) - 1;
        if($num_at != 1) {
            return false;
        }
        if(strpos($email,';') || strpos($email,',') || strpos($email,' ')) {
            return false;
        }
        if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email)) {
            return false;
        }
        return true;
    }
    function chkUsername($username){
        $username = trim($username);
         if(strlen($username) > 25){
             echo 'errore user';
             return false;
         }  
        return true;
    }
    function chkPassword($password,$passwordConfirm){
        $password = trim($password);
        $passwordConfirm = trim($passwordConfirm);
        if(strlen($password)<8){
         
            return false;
        }
        if($password != $passwordConfirm){
            
            return false;
        }

        return true;
    }


?>