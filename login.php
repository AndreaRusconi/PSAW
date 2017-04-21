
<?php

session_start(login);



$username=$_POST['username'];
$password=$_POST['password'];

$cryptpassword=crypt($password);
    
 
 
$search=string();
    
$righe = file('Users.txt');
foreach ($righe as $riga) {
    echo ' in foreach';
    $result = explode('   ', trim($riga));
    for ($j=0; $j<count($result); $j++) {
        echo 'in for';

  
        if ($result[$j]==$username) {
        //inseriamo il record trovato nell'array
            if($result[$j+2]==$cryptpassword){
                $_SESSION['login']=$user;
                header("Location:Homepage.php");
            }
            else 
                echo "<script>alert('Username o password errati!');</script>";
            
        }
    }

}
    


?>