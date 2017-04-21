<?php

session_start();


$username=$_POST['username'];
$password=$_POST['password'];

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
    }
    else
        echo "try again";
    
    fclose($myFile);
    
}
else 
    header('Location: login.html');    
?>