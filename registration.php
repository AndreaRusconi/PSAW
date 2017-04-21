
<?php

    $username = $_POST['UserName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    if(chkEmail($email)&&chkUsername($username)&& chkPassword($password,$passwordConfirm)) {
        echo 'Registrazione avvenuta con successo';
        $cryptpassword=md5($password);
        $userData = $username."-".$email."-".$cryptpassword;
        $userData.= "\r\n";
        $usersFile = "Users.txt";
        $fh = fopen($usersFile,'a+');
        fwrite($fh,$userData);
        fclose($usersFile);
    }
    else
        echo 'Errore';

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