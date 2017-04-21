
<?php

session_start();

//echo"temae";

$user=$_POST['userEmail'];
$password=$_POST['password'];

$cryptpassword= md5($password);
  
    
if(isset($user) && isset($password)){
   
    $good = false;
    $infile = fopen("Users.txt","r");
      $entry = fgets($infile);
    
         while (!feof($infile)) {
    
            $array = explode("-",$entry); 
            
             if((trim($array[0]) == $user || trim($array[1]) == $user) && trim($array[2]) == $cryptpassword){
                 $good = true;
            
                 break;
           
             }
            $entry = fgets($infile);
         }
    
    if($good){
        echo "welcome";
    }
    else{ 
        echo "try again";
    }
    fclose($myFile);
    

}
else 
    header('Location: login.html');

    
?>