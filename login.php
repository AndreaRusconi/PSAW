<?php

session_start();


$username=$_POST['username'];
$password=$_POST['password'];
$remember=$_POST['remember_me'];

$cryptpassword= md5($password);  
    
if(isset($username) && isset($password)){
   
    $good = false;
    $infile = fopen("Users.txt","r");
    $entry = fgets($infile);

    
    while (!feof($infile)) {
        $array = explode("-",$entry); 
        
        if(trim($array[0]) == $username && trim($array[2]) == $cryptpassword){
            $good = true;
             break;   
        }
        $entry = fgets($infile);
    }

    if($good){
        $_SESSION['username'] = $username;
        header('Location: homepageLoggata.php');
        if($remember) {
            setcookie("cookiename", $username, time() + 6000);
            setcookie("cookiepass", $password, time() + 6000);
        }
    }
    else
        echo "try again";
    
    fclose($infile);
    
}
else 
    header('Location: login.html');    
?>
