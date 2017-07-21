<?php

// Controlla se la sessione Ã¨ stata registrata, altrimenti rimanda alla pagina di login
// Questa prima parte dobbiamo inserirla in tutte le pagine che vogliamo proteggere con password prima di qualsiasi altra cosa
session_start();

if(!isset($_SESSION['username'])){
    header ("location:login.php");
}
include("db_con.php");

$username = $_SESSION['username'];
$conn = connection();  

    $stmt = $conn->prepare("SELECT nome,cognome,email,citta FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($name,$surname,$email,$city);
    $stmt->fetch();
    $stmt->close();




if(isset($_POST['submit'])) {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    
    
    
    
     
    $stmt1 = $conn->prepare("UPDATE users SET email=?, nome=?, cognome=? ,citta=? WHERE username = '{$username}'");
    $stmt1->bind_param("ssss", $email, $name, $surname, $city);
    
    $stmt1->execute();
    
    $stmt1->close();
    $conn->close();
    
    
    header ("location:generalProfile.php?var=$username");
}


if(empty($name)){
    $name = 'none';
}

if(empty($surname)){
    $surname = 'none';
}

if(empty($email)){
    $email = 'none';
}


?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/Bar.css" />
    <title>Modify</title>
</head>

<body>

<ul id="menu">
    <li class="other"><a href="logout.php">logout</a></li>
    <li class="other"><a href="generalProfile.php?var=<?php echo $_SESSION['username'] ?>" > <?php echo $_SESSION['username'] ?> </a></li>
    <li class="barra"><a>|</a></li>
    <li class="other"><a href="info.php">info</a></li>
    <li class="other"><a href="aboutUs.php">about us</a></li>
    <li class="event"><a href="index.php"><img src="CSS/Images/logo.png" height="50px" width="140px"></a></li>
</ul>



<form class="blocco_campi" method = "post" >
    <div id="intestazione_blocco_campi">Modifica profilo</div>
    
    <div class="box">
    <label for="name">Name</label>
    </div>
    <input id="name"  name="name"  class="modifiche" type="text" required="required" aria-required="true" value="<?php echo $name ?>">
    
    
    <div class="box">
    <label  for="surname">Surname</label>
     </div>
    <input id="surname" class="modifiche" name="surname" type="text" required="required" aria-required="true" value="<?php echo $surname ?>">
   
    <div class="box">
    <label  for="surname">Email</label>
     </div>
    <input id="email" class="modifiche" name="email" type="email" required="required" aria-required="true" value="<?php echo $email ?>">
    
    <div class="box">
    <label  for="city">City</label>
     </div>
    <input id="city" class="modifiche" name="city" type="text" required="required" aria-required="true" value="<?php echo $city ?>">
    
    
    
    <a href="mod_pass.php" id="to_modifica_pass">Modifica password </a>
    <input class="tasto_giallo" name = "submit" type = "submit" value = "Conferma">

</form>
</body>