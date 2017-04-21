
<?php

session_start(login);



$username=$_POST['username'];
$password=$_POST['password'];

//$cryptpassword=password_hash($password,PASSWORD_DEFAULT);
    
//if(isset($username) && isset($password)){
    echo"<script> in if </script";
    $myfile=fopen('Users.txt', 'r');
    $good = false;
    
    while(!feof($myfyle)){
        $line = fgets($myfile);
        
        list($user, $pass)=explode('-', $line);
        
        if(trim($user)== $username && trim ($pass) == $password ){
            $good = true;
            break;
        }
        
    }
    if($good){
        echo 'welcome';
    }
    else 
        echo 'try again';
    
    fclose($myfile);
    

/*}
else 
    include 'login.html';*/

    
?>