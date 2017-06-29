<?php
include("db_con.php");
function chkEmail($email)
{
    $email = trim($email);
    if (!$email) {
        return false;
    }
    $num_at = count(explode('@', $email)) - 1;
    if ($num_at != 1) {
        return false;
    }
    if (strpos($email, ';') || strpos($email, ',') || strpos($email, ' ')) {
        return false;
    }
    if (!preg_match('/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email)) {
        return false;
    }
    return true;
}

function chkUsername($username)
{
    $username = trim($username);
    if (strlen($username) > 25) {
        echo 'errore user';
        return false;
    }
    return true;
}

function chkPassword($password, $passwordConfirm)
{
    $password = trim($password);
    $passwordConfirm = trim($passwordConfirm);
    if (strlen($password) < 8) {

        return false;
    }
    if ($password != $passwordConfirm) {

        return false;
    }

    return true;
}



if(isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $useromailgiainuso = false;



    $conn = connection();
    
    
    
    
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    
    $stmt->execute();
     $stmt->bind_result($user);
    
    
    $stmt->fetch();
        if ($user == $username){
                $useromailgiainuso = true;
                
            }
    
    $stmt->close();

    

    
    if (!$useromailgiainuso) {

        if (chkEmail($email) && chkUsername($username) && chkPassword($password, $passwordConfirm)) {

            
            $cryptpassword = sha1($password);


            $conn = connection();

            
            
            $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES(?,?,?)");
            $stmt->bind_param("sss", $username,$email,$cryptpassword);
            $stmt->execute();
            $stmt->close();
            header('Location: login.php');
        
        } else
            echo 'Errore, la password deve essere di almeno 8 caratteri,il nome utente deve essere al massimo di 25 caratteri';
    }
    echo "user gia in uso";

}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/registration.css" />
    <title>Accedi al tuo profilo</title>
</head>

<body>
<header>
    <p class="logoEvent"><a href="index.php"><img src="CSS/Images/logo.png" height="100px" width="300px"></a></p>
</header>

<form class="menu" method = "post" >

    <h1>Registrati</h1>

    <input name="username" id="userName" type="text" required="required" aria-required="true" autocomplete="off" placeholder="Inserisci username">

    <input name="email" id="email" type="email" required="required" aria-required="true" autocomplete="off" placeholder="Inserisci email">

    <input name="password" id="password" type="password" required="required" aria-required="true" autocomplete="off" placeholder="Inserisci password">

    <input name="passwordConfirm" id="passwordConfirm" type="password" class="passwordConfirm" required="required" aria-required="true" autocomplete="off" placeholder="Conferma password">

    <p id="new"></p>

    <input id="creaAccount" name = "submit" type = "submit" value = "Crea il tuo account Event">

</form>

<footer class="footer" role="contentinfo">
    <p class="footerCopyright">Nessun Copyright registrato. Tutti i diritti non sono riservati.</p>
</footer>



</body>
</html>
